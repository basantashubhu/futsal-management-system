<?php
/**
 * @author Suman Thaapa -- Lead
 * @author Prabhat gurung
 * @author Basanta Tajpuriya
 * @author Rakesh Shrestha
 * @author Manish Buddhacharya
 * @author Lekh Raj Rai
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function permission()
    {
        return $this->hasMany(Permission::class, 'page_id');
    }
}
