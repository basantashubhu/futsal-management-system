<?php


namespace App\Repo;


use App\Lib\Filter\EmailQueueFilter\EmailQueueFilter;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailQueuRepo extends BaseRepo
{
    private function certificateQuery()
    {
        return DB::table('email_queues')
            ->leftJoin('applications',function ($join) {
                $join->on('email_queues.application_id', '=', 'applications.id');
                $join->on('email_queues.table_name', '=', DB::raw('"application"'));
            })
            ->leftJoin('organization',function ($join) {
                $join->on('email_queues.application_id', '=', 'organization.id');
                $join->on('email_queues.table_name', '=', DB::raw('"organization"'));
            })
            ->leftJoin('users',function ($join) {
                $join->on('email_queues.application_id', '=', 'users.id');
                $join->on('email_queues.table_name', '=', DB::raw('"users"'));
            })

            ->leftJoin('clients', 'email_queues.client_id', 'clients.id')
            ->leftJoin('address', 'address.client_id', 'clients.id')
            ->leftJoin('zip_codes', 'address.zip_id', 'zip_codes.id')
            ->leftJoin('contacts', 'contacts.client_id', 'clients.id');

        /*->join('terms', function ($join) {
            $join->on('terms.table_id', '=', 'organization.id');
            $join->on('terms.table', '=', DB::raw('"organization"'));
        });*/
    }
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        // $result = $this->model->where('is_deleted', 0)->where('is_send', false)->with('client');
        $query = $this->certificateQuery()
            ->select('email_queues.*', 'clients.fname', 'clients.lname', 'clients.mname', 'contacts.cell_phone', 'zip_codes.city','applications.status', 'applications.alt_id', 'is_send', 'is_failed')
            ->where('email_queues.is_deleted', 0);
        
        $r = $request->all();
        if(!array_key_exists('query', $r) || (array_key_exists('query', $r) && $r['query']==null))
        {
            $query = $query->where('email_queues.is_send', 0)->orWhere('email_queues.is_failed', 1);
        }
        $totalResult = count($query->get());
        /* apply filter */
        $filter = new EmailQueueFilter($request);
        $query = $filter->getQuery($query);

        if (isset($request->sort['field']))
            $query = $query->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $query = $query->limit($perpage)->offset($offset);

        $result = $query->groupBy('id')->get();
        foreach($result as $d){
            if($d->to){
                $email = "st# ".$d->to;
                if(!strpos($email, 'demo')){
                    $d->email = $d->to;
                }else{
                    $d->email = "No Email";
                }
            }else{
                $d->email = "No Email";
            }
        }

        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }

}