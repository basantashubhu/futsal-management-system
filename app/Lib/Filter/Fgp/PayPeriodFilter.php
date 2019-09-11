<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PayPeriodFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $status = [];
        $siteName = '';
        $siteEmail = '';
        $phone = '';
        $supervisor = '';
        $siteExt = '';
        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'site_name'):
                    $siteName = $d['value'];
                elseif ($d['name'] == 'site_phone'):
                    $phone = $d['value'];
                elseif ($d['name'] == 'supervisor'):
                    $supervisor = $d['value'];
                elseif ($d['name'] == 'site_email'):
                    $siteEmail = $d['value'];
                elseif ($d['name'] == 'site_ext'):
                    $siteExt = $d['value'];
                elseif ($d['name'] == 'status[]'):
                    if(isset($d['value'])){
                        array_push($status, $d['value']);
                    }else{
                        $status =[];
                    }
                endif;
            endforeach;
        endif;

        if ($siteName)
            $this->siteName($siteName);

        if ($status)
            $this->status($status);

        if ($phone)
            $this->phone($phone);

        if ($supervisor)
            $this->supervisor($supervisor);

        if ($siteEmail)
            $this->siteEmail($siteEmail);

        if ($siteExt)
            $this->siteExt($siteExt);
    }
    public function pay_code($query = false)
    {
        if ($query) {
            return $this->builder->where('pay_code', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function phone($query = false)
    {
        if ($query) {
            return $this->builder->where('phone', $query);
        }
        return $this->builder;
    }

    public function siteEmail($query = false)
    {
        if ($query) {
            return $this->builder->where('site_email', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function siteExt($query = false)
    {
        if ($query) {
            return $this->builder->where('site_ext', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function date_range($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                return $this->builder->whereBetween('start_date', [$start, $end]);
            }else{
                return $this->builder->where('start_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }

    /*
     * time - sheet view search stipend period
     * */
    public function period_no($ids = null) {
        if ($ids) {
            $exp = explode(',', $ids);
            return $this->builder->whereIn('id', $exp);
        }
        return $this->builder;
    }

    public function supervisor($users = null)
    {
        if ($users) {
            $users = Member::select('user_id')
                ->whereIn(DB::raw('CONCAT(first_name, " ", last_name)'), explode(',', $users))
                ->get()->pluck('user_id')->all();
            return $this->builder->whereHas('timesheets', function($ts) use($users){
                $ts->whereHas('user', function($user) use($users){
                    $user->whereIn('id', $users);
                });
            });
        }
        return $this->builder;
    }

    public function stipend_period_status($status = null) {
        if ($status) {
            $query = (int)$status ? 'is not' : 'is';
            return $this->builder->where('closed_date', $query, NULL);
        }
        return $this->builder;
    }

    // dashboard
    public function pay_stat($state) {
        if (!$state) return $this->builder;
        return $this->builder->where('pay_stat', $state);
    }
    public function end_date($range) {
        if (!$range) return $this->builder;
        $range = explode(' - ', $range);
        $start = date('Y-m-d', strtotime($range[0]));
        $end = date('Y-m-d', strtotime($range[1]));
        return $this->builder->whereDate('start_date', '>=', $start)
                            ->whereDate('end_date', '<=', $end);
    }
}