<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use App\Models\UserSettings;
use Illuminate\Http\Request;

class UserSettingsController extends BaseController
{
    private static $repo = null;
    /**
     * @var string
     */
    private $clayout = '';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.usersettings';
    }


    public function store(Request $request)
    {

        $usersetting = $this->getSettings($request);
        $usersetting->type = $request->type ? $request->type : 'notification';
        $usersetting->value = $request->value ? $request->value : '';
        $usersetting->user_id = auth()->id();
        $usersetting->code = $request->code;
        $usersetting->is_true = $request->is_true;
        $usersetting->save();
        return $this->response("Settings Added SuccessFully", "view", 200);
    }

    public function allSettings()
    {
        $user = auth()->user();
        return $user->settings;
    }

    public function getSettings(Request $request)
    {
        $user = auth()->user();
        $settings = $user->settings->pluck('code')->toArray();
        if (in_array($request->code, $settings)) {
            return $user->settings->where('code', $request->code)->first();
        } else {
            return new UserSettings;
        }
    }

    public function index()
    {
        return view($this->clayout . '.index');
    }

    public function Settings()
    {
        return UserSettings::where('is_deleted', false)->with('user')->get();
    }

    public function create()
    {
        return view($this->clayout . '.modal.add');
    }

    public function edit(UserSettings $settings)
    {
        return view($this->clayout . '.modal.edit', compact('settings'));
    }

    public function delete(UserSettings $settings)
    {
        return view($this->clayout . '.modal.delete', compact('settings'));
    }

    /**
     * @param Client $client
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function destroy(UserSettings $settings)
    {
        $settings->is_deleted = true;
        $settings->save();
        return $this->response("Settings deleted successFully", "view", 200);
    }
}
