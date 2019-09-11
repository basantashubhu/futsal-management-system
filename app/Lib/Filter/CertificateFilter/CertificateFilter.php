<?php


namespace App\Lib\Filter\CertificateFilter;


use App\Lib\Filter\AbstractFilter;

class CertificateFilter extends AbstractFilter
{
    public function status($status = '')
    {
        if ($status != '') {
            return $this->builder->whereIn('files.status', $status);
        }
        $this->builder;
    }

    public function status1($status = '')
    {
        if ($status != '') {
            return $this->builder->whereIn('files.status', $status);
        }
        $this->builder;
    }

    public function status2($status = '')
    {
        if ($status != '') {
            return $this->builder->where('files.status', $status);
        }
        $this->builder;
    }

    public function clientName($name = false)
    {
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('client.lname', 'LIKE', '%' . $lname . '%')->where('client.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function clientName1($name = false)
    {
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('client.lname', 'LIKE', '%' . $lname . '%')->where('client.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function applicationID($applicationID = '')
    {

        $field = 'id';
        if ($applicationID != '') {
            if (getSiteSettings('alt_id_true') == 'true') {
                preg_match_all('!\d+!', $applicationID, $applicationID);
                $field = 'alt_id';
            }

            return $this->builder->where('applications.' . $field, $applicationID);
        }
        return $this->builder;
    }

    public function email($email = false)
    {
        if ($email) {
            return $this->builder->where('personal_email', 'LIKE', '%' . $email . '%');
        }
        return $this->builder;
    }

    public function dateRange($range = false)
    {
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:59:59', strtotime($range[1]));
            return $this->builder->whereBetween('files.created_at', [$start, $end]);
        }
        return $this->builder;
    }

}