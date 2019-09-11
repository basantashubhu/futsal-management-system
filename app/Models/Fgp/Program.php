<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Program extends Model
{
    protected $table = 'program';

    /**
     * get all properties of current program
     */
    static function properties() {
        $self_properties = self::oldProperties();
        $new_properties = self::newProperties();
        return $self_properties->merge($new_properties);
    }

    static function mergedOldProperties() {
        $self_properties = self::oldProperties();
        $props = $self_properties->pluck('property')->toArray();
        $new_properties = self::newProperties('property', 'IN', $props);
        return $self_properties->map(function($pt) use($new_properties) {
            $data = $new_properties->firstWhere('property', $pt->property);
            $pt->value = $data ? $data->value : $pt->value;
            $pt->value2 = $data ? $data->value2 : $pt->value2;
            return $pt;
        });
    }

    /**
     * get all old properties of current program
     * @return \Illuminate\Support\Collection
     */
    static function oldProperties() {
        $arguments = func_get_args();
        return DB::table('program')->select('id', 'property', 'value', 'value2')
            ->when(func_num_args(), function($query) use($arguments) {
                if (isset($arguments[1]) && ($arguments[1] == 'in' || $arguments[1] == 'IN'))
                    $query->whereIn($arguments[0], $arguments[2]);
                else
                    $query->where(...$arguments);
            })->get();
    }

    /**
     * get all new properties of current program
     * @return \Illuminate\Support\Collection
     */
    static function newProperties() {
        $arguments = func_get_args();
        return DB::table('program_default')->select(['id', 'property', 'value', 'value2'])
            ->when(func_num_args(), function($query) use($arguments){
                if (isset($arguments[1]) && (strtolower($arguments[1]) == 'in'))
                    $query->whereIn($arguments[0], $arguments[2]);
                else
                    $query->where(...$arguments);
            })->get();
    }
}
