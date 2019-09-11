<?php

use App\Models\DeveloperNote;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('validate-user', function (Request $request) {
    $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    $exists = \DB::table('users')->where([$field => $request->input('username')])->first();
    $errors = [];
    if ($exists) {
        if (!\Hash::check($request->input('password'), $exists->password)) {
            $errors['username'] = 'Invalid login credentials.';
        }
    } else {
        $errors['username'] = 'Invalid login credentials.';
    }
    $time = SiteSettings::firstOrNew(['code' => 'max_support_remember']);
    if (!$time->exists) {
        $time->description = "Support tool max time to remember a session";
        $time->section = "Support";
        $time->value = 1;
        $time->save();
    }
    if (count($errors)) {
        return response(['errors' => $errors], 422);
    } else {
        return response(['message' => 'User is validated.', 'remember_time' => $time->value], 200);
    }
});

Route::post('support/save', function (Request $request) {
    $required = array_reduce($request->keys(), function ($fields, $key) {
        $fields[$key] = 'required';
        return $fields;
    }, []);
    $request->validate($required);

    try {
        $data = $request->all();
        if (!is_numeric($data['userc_id'])) {
            $field = filter_var($data['userc_id'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            if ($user = \DB::table('users')->select('id')->where([$field => $data['userc_id']])->first()) {
                $data['userc_id'] = $user->id;
            } else {
                $data['userc_id'] = 1;
            }
        }
        $note = save_update(new DeveloperNote, $data);
        return response(['status' => 200, 'message' => 'Developer note saved successfully.', 'data' => $note], 200);
    } catch (\Exception $e) {
        return response(['status' => '500', 'message' => $e->getMessage()], 200);
    }
});
