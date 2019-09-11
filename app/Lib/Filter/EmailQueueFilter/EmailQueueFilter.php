<?php


namespace App\Lib\Filter\EmailQueueFilter;


use App\Lib\Filter\AbstractFilter;

class EmailQueueFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $clientName = '';
        $email = '';
        $applicationID = '';
        $status = [];
        foreach($data as $d):
            if($d['name'] == 'clientName'):
                $clientName = $d['value'];
            elseif($d['name'] == 'status'):
                $status = $d['value'];
                // array_push($status, $d['value']);
            elseif($d['name'] == 'email'):
                $email = $d['value'];
            elseif($d['name'] == 'applicationID'):
                $applicationID = $d['value'];
            endif;
        endforeach;

        if($clientName)
            $this->clientName($clientName);

        if($applicationID)
            $this->applicationID($applicationID);

        if($email)
            $this->email($email);

        if($status)
            $this->status($status);
    }
    public function status($status = "")
    {
        if ($status != "") {
            return $this->builder->whereIn('applications.status', $status);
        }
        return $this->builder;
    }

    public function emailStatus($emailStatus = "")
    {
        foreach($emailStatus as $status):
            if ($status != "") {
                if($status == "Sent"):
                    return $this->builder->where('email_queues.is_send', 1);
                elseif($status == "Not Sent"):
                    return $this->builder->where('email_queues.is_send', 0);
                else:
                    return $this->builder->where('email_queues.is_failed', 1);
                endif;
            }
        endforeach;
        return $this->builder;
    }

    public function applicationID($id = false)
    {
        $field = 'application_id';
        if (getSiteSettings('alt_id_true') == 'true') {
            preg_match_all('!\d+!', $id, $id);
            $field = 'applications.alt_id';
        }
        if ($id) {
            return $this->builder->where($field, $id);
        }
        return $this->builder;
    }

    public function clientName($name = false)
    {
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%')->where('clients.mname', 'LIKE', '%' . $mname . '%');
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
            return $this->builder->whereBetween('email_queues.created_at', [$start, $end]);
        }
        return $this->builder;
    }
}