<?php

// namespace Helpers;

use App\Models\Fgp\Holiday;
use App\Models\Fgp\StipendItem;
use App\Models\LayoutBuilder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

//

/**
 * loop through data array and set property to target object
 * @param       $target
 * @param array $data
 * @param bool  $save
 * @return mixed $target
 */
function save_update($target, $data = array(), $save = true)
{
    if ($target->exists) {
        $data['useru_id'] = auth()->id();
    }
    foreach ($data as $key => $value) {
        $target->$key = $value;
    }

    $save = $save ? $target->save() : false;
    return $target;
}

/**
 * custom debugger function which simply print data and end execution
 * @param mixed ...$args
 */
function debugger(...$args)
{
    echo '<pre>';
    foreach ($args as $arg) {
        print_r($arg);
    }

    echo '</pre>';
    exit;
}

/**
 * format given date to default format configured in config/app.php
 * @param        $date
 * @param string|bool $format
 * @return false|string
 */
function newDate($date, $format = false)
{
    $config_format = config('app.date-format') ?: 'm/d/Y';
    $format = $format ?: $config_format;
    if ($date instanceof \Carbon\Carbon) {
        return $date->format($format);
    }

    $date = is_string($date) ? strtotime($date) : $date;
    return date($format, $date ?: strtotime('today'));
}

/**
 * automatic dateRange generator
 * @param $year
 * @return string
 */
function dateRange($year)
{
    return newDate(strtotime("1 january $year")) . ' - ' . newDate(strtotime("31 dec $year"));
}

/**
 * numeric format with default 2 decimal points
 * @param     $number
 * @param int $decimals
 * @return string
 */
function nf($number, $decimals = 2)
{
    if (!is_numeric($number)) {
        return '';
    }

    return number_format($number, $decimals, '.', '');
}

/**
 * carbon helper for carbon instance
 * @param $dateString
 * @return \Carbon\Carbon
 */
function carbon($dateString)
{
    if (gettype($dateString) === 'integer') {
        return \Carbon\Carbon::createFromTimestamp($dateString);
    }

    return \Carbon\Carbon::parse($dateString);
}

/**
 * finds the key in $collection and returns the value if not returns $default value
 * @param      $collection
 * @param      $key
 * @param null $default
 * @return null|$property->value|$property->value2
 */
function program($collection, $key, $default = null)
{
    $property = $collection->firstWhere('property', $key);
    return $property ? ($property->value ?: $property->value2): $default;
}

/**
 * converts decimal to numeric total hours i.e hh:mm
 * @param $dec
 * @return string
 */
function format_hrs($dec)
{
    if (!is_numeric($dec)) {
        return $dec;
    }

    $hour = floor($dec);
    $min = round(60 * ($dec - $hour));
    $hour = preg_replace('/(\d)(?=(\d{3})+(?!\d))/', '$1,', $hour);
    return sprintf('%s:%s', $hour, $min < 10 ? "0$min" : $min);
}

/**
 * format cell in us standard
 * @param $cell
 * @return string
 */
function format_cell($cell): string
{
    return preg_replace('#(\d{3})(\d{3})(\d{4})#', '($1) $2-$3', $cell);
}

function holiday_name($date)
{

    $hol_name = Holiday::where('hol_date', $date)->where('is_deleted', 0)->first();

    return $hol_name ? ucfirst($hol_name->name) : '';
}

function fetch_auth_name()
{
    return implode(' ', array_filter(array_map('trim', Auth::user()->member->only('first_name', 'middle_name', 'last_name'))));
}

if (!function_exists('format_to_us_date')) {
    function format_to_us_date($dateToFormat)
    {
        return date_create($dateToFormat)->format('m/d/Y');
    }
}

/**
 * Join the properties of object | array with given concatinator
 * @param mixed $super Master object | array
 * @param array $props Concatable properties of master object | array
 * @param string $concatinator String concatinator of properties
 * @return string
 */
function filter_join(mixed $super, array $props, string $concatinator = ', '): string
{
    $arrayFunc = function ($props, $super) {
        $result = [];
        foreach ($props as $index) {
            if (isset($super[$index]) && trim($super[$index])) {
                $result[] = trim($super[$index]);
            }
        }
        return $result;
    };

    $objectFunc = function ($props, $super) {
        $result = [];
        foreach ($props as $index) {
            if (isset($super->$index) && trim($super->$index)) {
                $result[] = trim($super->$index);
            }
        }
        return $result;
    };

    $result = getType($super) == 'array' ? $arrayFunc($props, $super) : $objectFunc($props, $super);
    return implode($concatinator, $result);
}

function base64_logo()
{
    return require 'base64logo.php';
}

function holiday_item()
{
    return StipendItem::where('item_code', 'Holiday')->firstOrFail();
}

if (!function_exists('globalFontSize')) {
    function globalFontSize()
    {
        $layout = LayoutBuilder::where('setting_label', "global_font_size")->where('user_id', auth()->id())->first();
        if ($layout) {
            if ($layout->applied_value == "default") {
                return null;
            } else {
                return $layout->applied_value;
            }
        } else {
            return null;
        }
    }
}

if (!function_exists('intelligent_time')) {
    function intelligent_time($timeIn, $timeOut, $type)
    {

        $start = explode(":", $timeIn);
        $end = explode(":", $timeOut);

        $startHour = (int) $start[0];
        $endHour = (int) $end[0];

        if ($startHour >= 6 && $startHour < 12) {
            //timeIn is am
            $startStamp = " am";

        } else {
            //timeIn is pm
            $startStamp = " pm";
        }

        if ($endHour < $startHour && $endHour < 12) {
            $endStamp = " pm";

        } else if ($endHour >= 12) {
            $endStamp = " pm";
        } else {
            $endStamp = " am";
        }

        if ($type == "time_in") {
            return $startHour . ":" . $start[1] . $startStamp;
        }
        return $endHour . ":" . $end[1] . $endStamp;

    }
}
