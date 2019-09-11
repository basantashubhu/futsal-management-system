<?php


use App\Models\Settings\Validation;
use \App\Models\User;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Crypt;
use App\Models\File;
use App\Models\ApplicationPet;
use App\Models\Pet;
use App\Models\Client;

/*
 * retrieves validation value of name
 * @param name of setting
 * @return value of setting
 * */
function validation_value($name)
{
    $valid = [];
    if ($validation = Validation::where('code', $name)->first()) {
        $values = $validation->value;
        $fields = explode(",", $values);
        foreach ($fields as $field) {
            $f = explode(":", $field);
            $valid[$f[0]] = $f[1];
        }
    }
    return $valid;
}
// check whether it is valid or not inside form
function is_valid($key, $haystack) {
    return isset($haystack[$key]) && preg_match('/required/', $haystack[$key]) ? 'required' : '';
}

//For site settings dashboard logo
function dashboard_logo($code)
{
    if ($setting = SiteSettings::where('code', $code)->first()) {
        $value = $setting->value;
        return $value;
    }
}

function checkSettings($code, $user = false)
{
    if (!$user)
        $user = auth()->user();
    else if (!$user instanceof User)
        $user = User::find($user);

    $settings = $user->settings;
    foreach ($settings as $setting) {
        if ($setting->code == $code) return $setting->is_true;
    }
    return false;
}

function CheckNotificationSetting($code, $user)
{
    $user = User::find($user);

    $settings = $user->settings;
    foreach ($settings as $setting) {
        if ($setting->code == $code) {
            if (!$settings->value) return false;
        }
    }
    return true;
}

function is_json($string)
{
    return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function hasOperator($value, $operator)
{
    return strpos($value, $operator) !== false;
}

function getSiteSettings($code)
{
    if ($settings = SiteSettings::where('code', $code)->first()) {
        return $settings->value;
    }
    return false;
}

function random_string($length = 16)
{
    return str_random($length);
}

function email_mode()
{
    if ($settings = SiteSettings::where('code', 'email_mode')->first()) {
        if ($settings->value == 'queue') {
            return true;
        }
    }
    return false;
}

function email_app_review__mode()
{
    if ($settings = SiteSettings::where('code', 'mail_application_review')->first()) {
        if ($settings->value == 'true') {

            return true;
        }
    }
    return false;
}

function email_app_approved__mode()
{
    if ($settings = SiteSettings::where('code', 'mail_application_approved')->first()) {
        if ($settings->value == 'true') {
            return true;
        }
    }
    return false;
}

function client_credential_sent_mode()
{
    if ($settings = SiteSettings::where('code', 'EmailQueue-Clients')->first()) {
        if ($settings->value == 'True') {
            return true;
        }
    }
    return false;
}

function modal_add_mode($code)
{
    if ($settings = SiteSettings::where('code', $code)->first()) {
        if ($settings->value == 'Modal') {
            return true;
        }
    }
    return false;
}

function sitedateformat()
{
    if ($settings = SiteSettings::where('code', 'date_format')->first()) {
//        dd($settings->value);
        return $settings->value;
    }
    return "MM/DD/YYYY";
}

function sitedateformatphp()
{
    if ($settings = SiteSettings::where('code', 'date_format_php')->first()) {
//        dd($settings->value);
        return $settings->value;
    }
    return "m/d/Y";
}


function format_date($date)
{
    return Date(sitedateformatphp(), strtotime($date));
}

//decrypt string
function decryptString($string)
{
    return Crypt::decryptString(Crypt::decryptString($string));
}

//check for expirey date of certificate
function expiryDateCertificate($string)
{
    $date = SiteSettings::where('code', $string)->first();
    return $date->value;
}

//value from site settings table
function siteSettingsValue($code)
{
    if ($date = SiteSettings::where('code', $code)->first())
        return $date->value;
    return false;
}

//return logo
function getLogo($table, $table_id)
{
    if($table == 'organization'):
        $file = File::where('table', $table)->where('table_id', $table_id)->where('document_title', 'logo')->first();
    else:
        $file = File::where('table', $table)->where('table_id', $table_id)->first();
    endif;
    if (!is_null($file)):
        $filePath = storage_path('uploads' . DIRECTORY_SEPARATOR . $file->file_name);
        if (file_exists($filePath)):
            $mimeType = mime_content_type($filePath);
            if (isImageMime($mimeType))
                return $file->file_name;
            else
                return 'logo.png';
        else:
            return 'logo.png';
        endif;
    else:
        return 'logo.png';
    endif;
}

function cleaner($mapField, $data)
{
    $dataArr = [];
    foreach ($data as $d) {
        $singleRow = [];
        foreach ($mapField as $map) {
            if (array_key_exists($map, $d)) ;
            $singleRow[$map] = $d->$map;
        }
        array_push($dataArr, $singleRow);
    }
    return $dataArr;
}

function emailNameFrom($code)
{
    if ($data = SiteSettings::where('code', $code)->first()):
        return $data->value;
    else:
        return config('app.name');
    endif;
}

function getLookUPDesc($code,$value)
{
    $desc=\App\Models\Settings\Lookups::where('code',$code)->where('value',$value)->first();
    if($desc)
        return $desc->description;
    else
        return '';
}

function get_fake_email()
{
    $faker = Faker\Factory::create();
    return $faker->email;
}

function get_fake_state()
{
    return 'DE';
}
function cert_number($pet,$app)
{
    $c = ApplicationPet::where('pet_id', $pet)->where('application_id', $app)->first();
    return $c->cert_number;
}
function appType($pet,$app)
{
    $c = ApplicationPet::where('pet_id', $pet)->where('application_id', $app)->first();
    $pet = Pet::find($c->pet_id);
    $client = Client::find($pet->client_id);
    if(!isset($client->org_id)){
        return 'IE';
    }elseif($client->org_id == $c->provider_id){
        return 'NP';
    }elseif(isset($client->org_id) && ($client->org_id == null || $client->org_id != $c->provider_id)){
        return 'Rescue';
    }
}
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'browser'      => $bname,
        'browser_version'   => $version,
        'os'  => $platform
    );
} 