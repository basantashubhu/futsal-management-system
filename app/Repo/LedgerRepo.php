<?php


namespace App\Repo;


use App\Lib\Filter\LedgerFilter\LedgerFilter;
use App\Models\InvoiceBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'] == 0 ? 100000 : $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('ledgers')
            ->join('organization', 'organization.id', 'ledgers.provider_id')
            ->join('address', 'address.org_id', 'organization.id')
            ->leftjoin('zip_codes', 'address.zip_id', 'zip_codes.id')
            ->join('contacts', 'contacts.org_id', 'organization.id')
            ->crossJoin(DB::raw('(SELECT @b := 0.0) AS dummy'));

        if (getSiteSettings('batch_invoice_show') == 'True') {
            $result = $result->select('ledgers.*',
                DB::raw("IF(ref_type='invoice',CONCAT('INV-',invoice_ids),NULL) AS invoice_id,
                            IF(ref_type='voucher' OR ref_type='refund',CONCAT('VN',invoice_ids),NULL) AS voucher_no"),
                'organization.cname',
                DB::raw('COALESCE(address.city,zip_codes.city) as city'),
                DB::raw('COALESCE(address.zip_code,zip_codes.zip_code) as zip_code'),
                DB::raw('COALESCE(address.state,zip_codes.state) as state'),
                'organization.type',
                DB::raw('sum(dr_amount) as dr_amount'),
                DB::raw('sum(cr_amount) as cr_amount'),
                DB::raw('@b := @b + COALESCE(sum(ledgers.dr_amount),0) - COALESCE(sum(ledgers.cr_amount),0) AS balance'),
                DB::raw('(SELECT GROUP_CONCAT(batch_no) FROM invoice_batch WHERE id IN (ledgers.batch_id)) as batch_no'),
                DB::raw('IFNULL(batch_id,UUID()) as unq_batch_id')
            )->groupBy('unq_batch_id');
        } else {
            $result = $result->select('ledgers.*',
                DB::raw("IF(ref_type='invoice',CONCAT('INV-',invoice_ids),NULL) AS invoice_id,
                            IF(ref_type='voucher' OR ref_type='refund',CONCAT('VN',invoice_ids),NULL) AS voucher_no"),
                'organization.cname',
                DB::raw('COALESCE(address.city,zip_codes.city) as city'),
                DB::raw('COALESCE(address.zip_code,zip_codes.zip_code) as zip_code'),
                DB::raw('COALESCE(address.state,zip_codes.state) as state'),
                'organization.type',
                DB::raw('@b := @b + COALESCE(ledgers.dr_amount,0) - COALESCE(ledgers.cr_amount,0) AS balance')
            );
        }
        $r = $request->all();
        if(!array_key_exists('query', $r) || (array_key_exists('query', $r) && $r['query']==null)){
            $start = date("Y-01-01");
            $end = date("Y-12-31");
            $result = $result->whereBetween('ledgers.created_at', [$start, $end]);

        }

        $filter = new LedgerFilter($request);
        if (auth()->user()->role->name == 'serviceProvider' || auth()->user()->role->name == 'non_profit') {
            $result = $result->where('ledgers.provider_id', auth()->user()->organization()->id);
        }
        $result = $filter->getQuery($result);
        // $result = $filter->getQueryNormal($result);

        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);


        $result = $result->get();
        $data = [
            'meta' => [
                'page' => $request->pagination['page'] == null ? 1 : $request->pagination['page'],
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

    public function exportData(Request $request)
    {
        $sortField = $request->sort_field;
        if($sortField == ''){
            $sortField = 'created_at';
        }
        $sortvalue = $request->sort_value;
        if($sortvalue == ''){
            $sortvalue = 'desc';
        }
        $result = DB::table('ledgers')
            ->join('organization', 'organization.id', 'ledgers.provider_id')
            ->join('address', 'address.org_id', 'organization.id')
            ->leftjoin('zip_codes', 'address.zip_id', 'zip_codes.id')
            ->join('contacts', 'contacts.org_id', 'organization.id')
            ->crossJoin(DB::raw('(SELECT @b := 0.0) AS dummy'));

        if (getSiteSettings('batch_invoice_show') == 'True') {
            $result = $result->select('ledgers.*',
                DB::raw("IF(ref_type='invoice',CONCAT('INV-',invoice_ids),NULL) AS invoice_id,
                            IF(ref_type='voucher' OR ref_type='refund',CONCAT('VN',invoice_ids),NULL) AS voucher_no"),
                'organization.cname',
                DB::raw('COALESCE(address.city,zip_codes.city) as city'),
                DB::raw('COALESCE(address.zip_code,zip_codes.zip_code) as zip_code'),
                DB::raw('COALESCE(address.state,zip_codes.state) as state'),
                'organization.type',
                DB::raw('sum(dr_amount) as dr_amount'),
                DB::raw('sum(cr_amount) as cr_amount'),
                DB::raw('@b := @b + COALESCE(sum(ledgers.dr_amount),0) - COALESCE(sum(ledgers.cr_amount),0) AS balance'),
                DB::raw('(SELECT GROUP_CONCAT(batch_no) FROM invoice_batch WHERE id IN (ledgers.batch_id)) as batch_no'),
                DB::raw('IFNULL(batch_id,UUID()) as unq_batch_id')
            )->groupBy('unq_batch_id');
        } else {
            $result = $result->select('ledgers.*',
                DB::raw("IF(ref_type='invoice',CONCAT('INV-',invoice_ids),NULL) AS invoice_id,
                            IF(ref_type='voucher' OR ref_type='refund',CONCAT('VN',invoice_ids),NULL) AS voucher_no"),
                'organization.cname',
                DB::raw('COALESCE(address.city,zip_codes.city) as city'),
                DB::raw('COALESCE(address.zip_code,zip_codes.zip_code) as zip_code'),
                DB::raw('COALESCE(address.state,zip_codes.state) as state'),
                'organization.type',
                DB::raw('@b := @b + COALESCE(ledgers.dr_amount,0) - COALESCE(ledgers.cr_amount,0) AS balance')
            );
        }

        $filter = new LedgerFilter($request);
        if (auth()->user()->role->name == 'serviceProvider' || auth()->user()->role->name == 'non_profit') {
            $result = $result->where('ledgers.provider_id', auth()->user()->organization()->id);
        }
        // $result = $filter->getQuery($result);
        $result = $filter->getQueryNormal($result);

        $result = $result->orderBy($sortField, $sortvalue);


        return $result->get();
    }

    public function formatBatchData($result)
    {
        $merger = [];

        $checkifExist = [];

        $amt = 0;

        foreach ($result as $res) {
            $ids = explode(',', $res->invoice_ids);
            $batchId = InvoiceBatch::whereIn('invoice_ids', $ids)->pluck('batch_id');
            if (!in_array($batchId, $checkifExist))
                array_push($checkifExist, $batchId);
            else {

            }
        }
    }
}