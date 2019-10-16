<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\EmailSettingsModel;
use App\Models\File;
use App\Models\Member;
use App\Models\Note;
use App\Models\Role;
use App\Models\User;
use App\Repo\UserRepo;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LogicException;

class UserController extends BaseController
{
    private static $repo = null;
    protected $clayout = "";

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.user';
    }

    /**
     * @param $model
     * @return UserRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null) {
            self::$repo = new UserRepo($model);
        }

        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();
        return view($this->clayout . '.modal.add', compact('roles'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {

        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();

        return view($this->clayout . '.modal.edit', compact('roles', 'user'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        $data = self::getInstance('User')->selectDataTable($request);
        return $data;
    }

    public function userList(Request $request)
    {
        return self::getInstance('User')->userList($request);
    }

    /**
     * to store the user details
     * @param UserRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'name' => 'required|unique:users,name',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required',
        ]);

        $userData = $request->only([
            'name', 'email', 'password', 'role_id',
        ]);

        DB::transaction(function () use ($userData, $request) {

            $user = self::getInstance('User')->saveUpdate($userData);

            if ($user) {

                $user->self()->create([

                    'first_name' => $request->fname,
                    'last_name' => $request->lname,

                ]);

            }

            return $this->response("User added successFully", "view", 200);

        });

    }

    /**
     * to update the user details except password
     * @param UserEditRequest $request
     * @param User            $user
     * @return UserController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(UserEditRequest $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $user) {
            $userData = $request->only([
                'name', 'email', 'alt_id', 'role_id',
            ]);
            $res = self::getInstance($user)->saveUpdate($userData);

            $user->self()->update([
                "first_name" => $request->fname,
                "last_name" => $request->lname,
            ]);

            if ($res) {
                return $this->response("User edited successFully", "view", 200);
            } else {
                return $this->response("Can't edit user", 'view', 422);
            }

        });
    }

    public function changePassword(User $user)
    {
        return view($this->clayout . '.modal.changePassword', compact('user'));
    }

    public function checkPass(Request $request, User $user)
    {
        // $user = User::find(auth()->id());
        if (Hash::check($request->pass, $user->password)) {
            return response()->json(['pass' => 'true']);
        } else {
            return response()->json(['pass' => 'false']);
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return $this->response("Password changed Successfully", "view", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response("Failed to change Password", 'view', 422);
        }
    }

    public function userProfile($id = null)
    {
        $id = $id ?: auth()->id();
        $email = EmailSettingsModel::where('user_id', $id)->first();
        $notes = Note::where('userc_id', $id)->orderBy('created_at', 'desc')->limit(8)->get();
        $i = 1;
        foreach ($notes as $note):
            $note->line = $i++;
        endforeach;
        $member = Member::where('user_id', $id)->first();
        $user = User::find($id);
        if (is_null($member)) {
            return $this->response("Profile Not Found", "error", 500);
        }
        $profile = File::where('table', 'members')->where('table_id', $member->id)->first();

        $sig = File::where('table', 'users')->where('table_id', $id)->where('document_title', 'signature')->first();

        if (!is_null($profile)) {
            if (file_exists(storage_path('uploads/') . $profile->file_name)):
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/') . $profile->file_name));
            else:
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/avatar.jpg')));
            endif;
        }

        $address = $member->address->exists ? $member->address : null;
        $contact = $member->contact->exists ? $member->contact : null;
        $client = $member;

        return view('default.fgp.profile.index', compact('profile', 'notes', 'email', 'user', 'sig', 'client', 'address', 'contact'));
    }

    public function delete(User $user)
    {
        return view($this->clayout . '.modal.delete', compact('user'));
    }
    public function destroy(Request $request, User $user)
    {
        $user->is_deleted = true;
        $user->is_active = false;
        $user->save();
        return $this->response("User Successfully Deleted", "view", 200);
    }

    public function checkUserEmail(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->has('user_id')) {

                $this->checkToUpdateUserId($request, $user);

            } else {

                throw new LogicException("User of that email already exists");

            }

        }

    }

    public function checkToUpdateUserId(Request $request, User $user)
    {

        if ($user->id !== (int) $request->user_id) {
            throw new LogicException("User of that username already exists");
        }

    }

    public function checkUserName(Request $request)
    {

        $user = User::where("name", $request->name)->first();

        if ($user) {

            if ($request->has('user_id')) {

                $this->checkToUpdateUserId($request, $user);

            } else {

                throw new LogicException("User of that username already exists");

            }

        }

    }

    public function profileUpdate(Request $request, User $user)
    {
        $repo = static::getInstance($user);
        $repo->saveUpdate($request->only('email'));
        $repo->updateRelation('member', $request->only('first_name', 'middle_name', 'last_name'));
        $repo->updateRelation('member.address', $request->only('add1', 'city', 'state', 'zip_code'), $request->filled('add1'));
        $repo->updateRelation('member.contact', $request->only('cell_phone'), $request->filled('cell_phone'));
        return $this->response('Details successfully updated.', $user, 200);
    }
}
