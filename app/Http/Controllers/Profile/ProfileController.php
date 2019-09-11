<?php

namespace App\Http\Controllers\Profile;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Hash;
use App\Lib\File\FileUploader;
use App\Lib\Image\ImageThumb;
use App\Models\Client;
use App\Models\EmailSettingsModel;
use App\Models\Fgp\Volunteer;
use App\Repo\ProfileRepo;
use App\File;
use App\Models\Note;
use App\Http\Requests\EmailSettingsRequest;
use App\Models\Contact;
use App\Models\Address;

class ProfileController extends BaseController
{
    private $clayout = "";
    private static $repo = null;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.profile';
    }

    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new ProfileRepo($model);
        return self::$repo;
    }

    public function index()
    {
        $email = EmailSettingsModel::where('user_id', auth()->id())->first();
        $notes = Note::where('userc_id', auth()->id())->orderBy('created_at', 'desc')->limit(8)->get();
        $i = 1;
        foreach ($notes as $note):
            $note->line = $i++;
        endforeach;
        $client = Member::where('user_id', auth()->id())->first();
        if (is_null($client)) {
            return $this->response("Profile Not Found", "error", 500);
        }
        $profile = File::where('table', 'clients')->where('table_id', $client->id)->first();

        $sig = File::where('table', 'users')->where('table_id', auth()->id())->where('document_title', 'signature')->where('document_title', 'signature')->first();

        if (!is_null($profile)) {
            if (file_exists(storage_path('uploads/') . $profile->file_name)):
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/') . $profile->file_name));
            else:
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/avatar.jpg')));
            endif;
        }
        $address = Address::where('table_name', 'members')->where('table_id', $client->id)->first();
        $contact = Contact::where('table_name', 'members')->where('table_id', $client->id)->first();
        return $this->view($this->clayout . '.index', compact('profile', 'notes', 'email', 'sig', 'address', 'contact'));
    }

    public function loadMore($id)
    {
        $notes = Note::where('user_id', auth()->id())->skip($id)->orderBy('created_at', 'desc')->limit(8)->get();
        $i = 1;
        foreach ($notes as $note):
            $note->line = $i++;
        endforeach;
        return view($this->clayout . '.includes.loadMore', compact('notes'));
    }

    public function change_password()
    {
        return view($this->clayout . '.modal.change_password');
    }

    public function check_password(Request $request)
    {
        $user = User::find(auth()->id());
        if (Hash::check($request->pass, $user->password)) {
            return response()->json(['pass' => 'true']);
        } else {
            return response()->json(['pass' => 'false']);
        }
    }

    public function changePass(Request $request)
    {
        if (!(Hash::check($request->old_password, auth()->user()->password))) {
            return $this->response('Your current password doesnt matches with the password you provided. Please try again.', 'view', 422);
        }
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->response("Password Succesfully Changed.", "view", 200);
    }

    public function uploadImage($type, $id)
    {
        return view($this->clayout . '.modal.uploadProfile', compact('type', 'id'));
    }

    public function uploadProfile(Request $request, $type, $id)
    {
        if($type == "volunteer"){
            $client = Volunteer::find($id);
        }else if($type == 'user'){
            $client = Member::find($id);
        } else {
            $client = false;
        }
        if (!$client) return $this->response('User not found', 'view', 404);
        $fileName = $this->uploadAttachment($request->file());

        $repo = self::getInstance('Fgp\Volunteer');

        $res = $repo->storeUploadedFilePath($fileName, $client, 'profile image');
        if ($res):
            $profile = base64_encode(file_get_contents(storage_path('uploads/') . $fileName));
            return $this->response("Profile Picture uploaded Succesfully.", ['profile' => $profile], 200);
        endif;
    }

    /**
     * @param $file
     * @return array
     */
    public function uploadAttachment($file)
    {
        $fname = FileUploader::upload($file['photoIdProof'], true);
        return $fname;
    }

    public function emailSettings()
    {
        return view($this->clayout . '.includes.emailSettings');
    }

    public function storeEmailSettings(EmailSettingsRequest $request, $id)
    {
        try {
//            dd($request->all());
            $email = EmailSettingsModel::where('user_id', $id)->first();
            // dd($email);
            if (isset($email)) {
                $email = EmailSettingsModel::where('user_id', $id)->first();
                $email->email = $request->email;
                $email->email_from = $request->email_from;
                $email->server = $request->serverName;
                $email->password = $request->password;
                $email->mail_type = $request->mail_type;
                $email->is_auth_required = $request->is_auth_required;
                $email->is_ssl = 0;
                $email->is_tls = $request->is_tls;
                $email->user_id = $id;
                $email->save();
            } else {
                $email1 = new EmailSettingsModel();
                $email1->email = $request->email;
                $email1->email_from = $request->email_from;
                $email1->server = $request->serverName;
                $email1->password = $request->password;
                $email1->mail_type = $request->mail_type;
                $email1->is_auth_required = $request->is_auth_required;
                $email1->is_ssl = 0;
                $email1->is_tls = $request->is_tls;
                $email1->user_id = $id;
                $email1->save();
            }
            return $this->response("Email Settings Added Succesfully.", 'view', 200);
        } catch (\Exception $e) {
            dd($e);
            return $this->response("Email Settings Added Succesfully.", 'view', 200);
        }
    }

    public function insertSignature(Request $request)
    {
        try{
            $file = File::where('table', 'users')->where('table_id', auth()->id())->where('document_title', 'signature')->where('document_title', 'signature')->first();
            if(isset($file->file_name)):
                $file->file_name = $request->signature;
                $file->save();
            else:
                $file1 = new File();
                $file1->table = 'users';
                $file1->table_id = auth()->id();
                $file1->document_segment = 'signature';
                $file1->document_title = 'signature';
                $file1->document_type = 'image';
                $file1->file_name = $request->signature;
                $file1->status = 'New';
                $file1->save();
            endif;
            return $this->response("Signature Added Succesfully.", 'view', 200);
        }catch(\Exception $e) {
            dd($e);
            return $this->response("Could not Success.", 'view', 422);
        }
    }
}
