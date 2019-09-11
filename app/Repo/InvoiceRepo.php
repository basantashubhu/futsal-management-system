<?php


namespace App\Repo;


use App\Lib\InvoiceFilter\InvoiceBatchFilter;
use App\Lib\InvoiceFilter\InvoiceFilter;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceBatch;
use App\Models\InvoiceItem;
use App\Models\Organization;
use App\Models\Treatment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceRepo extends BaseRepo
{
    /**
     * @param Request $request
     * @param null $appId
     * @return array
     */
    public function selectDataTable(Request $request, $appId = null)
    {
        $role = auth()->user()->role;

        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('invoice_header as invoice')
            ->join('invoice_line_item as item', 'item.inv_id', '=', 'invoice.id')
            ->join('applications as app', 'app.id', '=', 'item.application_id')
            ->join('clients', 'invoice.client_id', '=', 'clients.id')
            ->join('organization', 'organization.id', '=', 'item.provider_id')
            ->select('invoice.*', 'item.provider_id', 'organization.cname', 'organization.id as org_id', 'clients.org_id as client_org_id', 'item.application_id as applicationId', 'app.alt_id as altId',
                DB::raw('CONCAT(clients.fname," ",COALESCE(clients.mname,"")," ",clients.lname) AS client_name'),
                DB::raw('(SELECT SUM(DISTINCT trans_amount) FROM payment WHERE payment.`table_id`=invoice.id) as payment_amount')
            )
            ->where('invoice.is_deleted', false);

        if ($role->name == 'non_profit' || $role->name == 'serviceProvider') {
            $client = auth()->user()->client;
            if ($client !== null)
                $result = $result->where('organization.id', $client->org_id);
        }

        $filter = new InvoiceFilter($request);
        $r = $request->all();
        if (array_key_exists('query', $r) && $r['query'] != null && array_key_exists('from', $r['query']) && $r['query']['from'] == 'application_page') {
            $result = $filter->getQuery($result);

        } else {
            if (isset($_COOKIE['invoice']) || isset($_COOKIE['invoice_quick'])) {
                $advData = isset($_COOKIE['invoice']) ? json_decode($_COOKIE['invoice']) : [];
                $openData = isset($_COOKIE['invoice_quick']) ? json_decode($_COOKIE['invoice_quick']) : [];
                $mergeData = array_merge($advData, $openData);
                $result = $filter->getQueryCookie($result, $mergeData);

            }
        }
        $result = $filter->getQuery($result);


        $result = $result->where('invoice.is_deleted', 0)
            ->groupBy('invoice.id');


        $requestData = $request->all();


        if ($appId != null)
            $result = $result->where('item.application_id', $appId);
//        elseif ($request->has('source'))
//            $result = $result->where('invoice.invoice_status', 'Pending');
        elseif (array_key_exists('query', $requestData) && $requestData['query'] == null)
            $result = $result->whereIn('invoice.invoice_status', ["Approved", "Pending", "Review"]);


        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();

        $data = [
            'meta' => [
                'page' => (int)$request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int)$perpage,
                'total' => (int)$totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;

    }

    /**
     * @param Request $request
     * @param null $appId
     * @return \Illuminate\Support\Collection
     */
    public function getReportData(Request $request, $appId = null)
    {
        $role = auth()->user()->role;

        $result = DB::table('invoice_header as invoice')
            ->join('invoice_line_item as item', 'item.inv_id', '=', 'invoice.id')
            ->join('applications as app', 'app.id', '=', 'item.application_id')
            ->join('clients', 'invoice.client_id', '=', 'clients.id')
            ->join('organization', 'organization.id', '=', 'item.provider_id')
            ->leftJoin('payment', 'payment.inv_id', '=', 'invoice.id')
            ->select('invoice.*', 'invoice.invoice_date as date', 'item.provider_id', 'organization.cname', 'organization.id as org_id', 'item.application_id as applicationId', 'app.alt_id as altId',
                DB::raw('CONCAT(clients.fname," ",COALESCE(clients.mname,"")," ",clients.lname) AS client_name'),
                DB::raw('sum(Distinct trans_amount) as payment_amount')
            );

        if ($role->id == 4 || $role->name == 'serviceProvider') {
            $client = auth()->user()->client;
            if ($client !== null)
                $result = $result->where('organization.id', $client->org_id);
        }

        $filter = new InvoiceFilter($request);
        $result = $filter->getQueryNormal($result);

        return $result->get();

    }

    /**
     * @param $client
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setInvoiceHeader($client, $date = null)
    {
        $invoice = $this->model;

        $invoice->client_id = $client->id;
        $invoice->invoice_date = is_null($date) ? date('Y-m-d') : date('Y-m-d', strtotime($date));
        $invoice->invoice_number = $this->getInvoiceNumber();
        $invoice->invoice_status = 'Approved';
        $invoice->invoice_type = "invoice";
        $invoice->save();
        return $invoice;
    }

    /**
     * @return mixed|string
     */
    public function getInvoiceNumber()
    {
        $invoiceNumber = Invoice::all()->last();
        if (!is_null($invoiceNumber)) {
            $invoiceNumber = $invoiceNumber->invoice_number;
            $inv = str_replace("DE-", "", $invoiceNumber);
            $inv++;
            $invoiceNumber = "DE-" . str_pad($inv, 5, '0', STR_PAD_LEFT);
            return $invoiceNumber;
        } else {
            $inv = 1;
            $invoiceNumber = "DE-" . str_pad($inv, 5, '0', STR_PAD_LEFT);
            return $invoiceNumber;
        }
    }

    /**
     * @param $invoice
     * @param $application
     * @throws \Exception
     */
    public function setInvoiceLineItem($invoice, $application)
    {
        $provider = $application->providers();
        // $ratePlans = $this->getRatePlan($application, $provider);
        $item = [];
        foreach ($application->pets as $pet) {
            $ratePlans = $this->getRatePlan($application, $pet, $provider);
            foreach ($ratePlans as $ratePlan) {
                if ($ratePlan->rate_metrics_type == 'weight' && $ratePlan->species == $pet->species) {
                    $res = $this->performComparision($pet->weight, $ratePlan->rate_metrics);
                    if ($res) {
                        $data = array(
                            'inv_id' => $invoice->id,
                            'client_id' => $invoice->client_id,
                            'provider_id' => $provider->id,
                            'application_id' => $application->id,
                            'vet_id' => $ratePlan->vet_id,
                            'animal_id' => $pet->id,
                            'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                            'service_description' => $ratePlan->treatment_name,
                            'copay' => getSiteSettings('copay_amount') * -1,
                            'amount_total' => $ratePlan->cost,
                            'created_at' => Carbon::now(),
                        );
                        array_push($item, $data);
                    }
                }
            }
        }
        if (count($item) > 0) {
            $this->model->insert($item);
        } else {
            throw new \Exception('Failed to generate invoice');
        }

    }

    /**
     * @param $invoice
     * @param $application
     */
    public function setCopayInvoice($invoice, $application)
    {
        $copayAmount = $application->pets->count() * getSiteSettings('copay_amount');
        $copay = $application->copay();
        $user = User::find($copay->userc_id);

        //check who receive copay
        if ($user->role->name == 'serviceProvider' || $user->role->name == 'non_profit') {
            $provider = $application->providers();
            $item = [];
            foreach ($application->pets as $pet) {
                $data = array(
                    'inv_id' => $invoice->id,
                    'client_id' => $invoice->client_id,
                    'provider_id' => $provider->id,
                    'application_id' => $application->id,
                    'vet_id' => 1,
                    'animal_id' => $pet->id,
                    'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                    'service_description' => 'copay',
                    'amount_total' => getSiteSettings('copay_amount') * -1,
                    'created_at' => Carbon::now(),
                );
                array_push($item, $data);
            }//end foreach
            if (count($item) > 0)
                $this->model->insert($item);
        } //end if
    }

    /**
     * @param $invoice
     * @param $application
     * @param $pet
     * @param string $treatment
     * @param string $vetId
     * @return \Illuminate\Database\Eloquent\Model|int
     */
    public function setInvoiceLineItemByPet($invoice, $application, $pet, $treatment = '', $vetId = '')
    {
        $cost = 0;
        $provider = $application->providers($pet->id);
        if ($vetId != 0 && $vetId != '') {
            $vet = Client::find($vetId);
            if ($vet)
                $provider = $vet->organization;
        }
        $item = [];
        $ratePlans = $this->getRatePlanN($application, $pet, $provider, $treatment);
        foreach ($ratePlans as $ratePlan) {
            if ($ratePlan->rate_metrics_type == 'weight' && $ratePlan->species == $pet->species) {
                $res = $this->performComparision($pet->weight, $ratePlan->rate_metrics);
                if ($res) {
                    $data = array(
                        'inv_id' => $invoice->id,
                        'client_id' => $invoice->client_id,
                        'provider_id' => $provider->id,
                        'application_id' => $application->id,
                        'vet_id' => $ratePlan->vet_id,
                        'animal_id' => $pet->id,
                        'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                        'service_description' => $ratePlan->treatment_name,
                        'copay' => getSiteSettings('copay_amount') * -1,
                        'amount_total' => $ratePlan->cost,
                        'created_at' => Carbon::now(),
                    );
                    array_push($item, $data);
                    $cost += $ratePlan->cost;
                }
            }
        }//endforeach
        if (count($item) > 0) {
            $this->model->insert($item);
            return $cost;
        }

        return $this->model;
    }

    /**
     * New invoice Line item generator and updator
     *
     * @param $invoice
     * @param $application
     * @param $pet
     * @param $treatment
     * @param $vet
     * @param $amt
     * @return \Exception
     */
    public function setInvoiceLineItemByTreatment($invoice, $application, $pet, $treatment, $vet=false, $amt, $copay, $pDate=false)
    {
        $invItem = InvoiceItem::where([
            ['inv_id', $invoice->id],
            ['application_id', $application->id],
            ['animal_id', $pet->id],
            ['treatment_id', $treatment->id],
        ])->first();
        // dd($invItem);


        $provider = $application->providers($pet->id);
            // dd($vet);
        try {
            if ($invItem) {
                if ($invItem->amount_total != $amt) {
                    $ledger = $this->storeLedgerOnUpdate($invoice, $application->id, $invItem->amount_total, $provider->id, 'dr');
                    $odata = $invItem->__toString();
                    $invItem->amount_total = $amt;
                    $invItem->save();
                    $this->audit($invItem->id, $odata, $invItem->__toString(), auth()->check() ? auth()->id() : 0);
                    $ledger = $this->storeLedgerOnUpdate($invoice, $application->id, $amt, $provider->id);
                }
            } else {
                $invoiceLineItem = New InvoiceItem();
                $invoiceLineItem->inv_id = $invoice->id;
                $invoiceLineItem->client_id = $invoice->client_id;
                $invoiceLineItem->provider_id = $provider->id;
                $invoiceLineItem->application_id = $application->id;
                $invoiceLineItem->vet_id = is_null($vet) ? null : $vet->id;
                $invoiceLineItem->animal_id = $pet->id;
                $invoiceLineItem->treatment_id = $treatment->id;
                if($pDate){
                    $invoiceLineItem->service_date = date('Y-m-d', strtotime($pDate));
                }else{
                    $invoiceLineItem->service_date = is_null($application->service_date) ? date('Y-m-d') : $application->service_date;
                }
                $invoiceLineItem->service_description = $treatment->treatment_name;
                $invoiceLineItem->copay = $copay;
                $invoiceLineItem->amount_total = $amt;
                $invoiceLineItem->save();
                $ledger = $this->storeLedger($invoice, $application);
            }
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function updateCopayOnly(InvoiceItem $invoiceItem, $copay)
    {
        // dd($invoiceItem);
        $invoiceItem->copay = $copay;
        $invoiceItem->save();
        echo $copay;       
    }
    // public function 

    public function updateInvoiceLineItem(InvoiceItem $invoiceItem, $invoice, $application, $pet, $treatment, $vet=false, $date,$amt)
    {
        // dd($invoiceItem);
        $provider = $application->providers($pet->id);
        $treatment = Treatment::find($treatment);
        $ledger = $this->storeLedgerOnUpdate($invoice, $application->id, $invoiceItem->amount_total, $provider->id, 'dr');
        $odata = $invoiceItem->__toString();
        // dd($vet);
        if($vet){
            $invoiceItem->vet_id = $vet;
        }
        $invoiceItem->amount_total = $amt;
        $invoiceItem->treatment_id = $treatment->id;
        $invoiceItem->service_date = date('Y-m-d', strtotime($date));
        $invoiceItem->service_description = $treatment->treatment_name;
        $invoiceItem->save();
        $this->audit($invoiceItem->id, $odata, $invoiceItem->__toString(), auth()->check() ? auth()->id() : 0);
        $ledger = $this->storeLedgerOnUpdate($invoice, $application->id, $amt, $provider->id);
    }

    /**
     * @param $invoice
     * @param $application
     * @param $pet
     */
    public function setCopayInvoiceByPet($invoice, $application, $pet)
    {

        $copay = $application->copayPet($pet->id);
        if ($copay) {
            $user = User::find($copay->userc_id);

            //check who receive copay
            if ($user->role->name == 'serviceProvider' || $user->role->name == 'non_profit') {
                $provider = $application->providers();
                $data = array(
                    'inv_id' => $invoice->id,
                    'client_id' => $invoice->client_id,
                    'provider_id' => $provider->id,
                    'application_id' => $application->id,
                    'vet_id' => 1,
                    'animal_id' => $pet->id,
                    'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                    'service_description' => 'copay',
                    'amount_total' => getSiteSettings('copay_amount') * -1,
                    'created_at' => Carbon::now(),
                );

                $this->model->insert($data);
            }
        }
        //end if
    }

    public function updateCopay($invoice, $pet, $copay)
    {
        // dd($copay);
        $invoiceLineItem = InvoiceItem::where('inv_id', $invoice->id)->where('animal_id', $pet->id)->where('service_description', 'copay')->where('co_no', '1')->first();
        // dd($invoiceLineItem);
        if (!is_null($invoiceLineItem) || $invoiceLineItem != 0) {
            $invoiceLineItem->amount_total = (int)$copay * -1;
            // $invoiceLineItem->co_no = '2';
            $invoiceLineItem->save();
        }else{
            $inv = InvoiceItem::where('inv_id', $invoice->id)->where('animal_id', $pet->id)->first();
            $data = array(
                'inv_id' => $invoice->id,
                'client_id' => $invoice->client_id,
                'provider_id' => $inv->provider_id,
                'application_id' => $inv->application_id,
                'vet_id' => 1,
                'animal_id' => $pet->id,
                'service_date' => is_null($inv->service_date) ? date('Y-m-d') : $inv->service_date,
                'service_description' => 'copay',
                'amount_total' => (int)$copay * -1,
                'created_at' => Carbon::now(),
            );

            $this->model->insert($data);
        }
    }

    public function setCopayInvoiceByTreatment($invoice, $application, $pet, $copay)
    {

        if ($copay) {

            //check who receive copay
            $provider = $application->providers();
            $data = array(
                'inv_id' => $invoice->id,
                'client_id' => $invoice->client_id,
                'provider_id' => $provider->id,
                'application_id' => $application->id,
                'vet_id' => 1,
                'animal_id' => $pet->id,
                'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                'service_description' => 'copay',
                'amount_total' => $copay * -1,
                'created_at' => Carbon::now(),
            );

            $this->model->insert($data);
        }
    }

    /**
     * @param $invoice
     * @param $application
     * @param int $amount
     * @return array
     * @throws \Exception
     */
    public function setCustomInvoiceLineItem($invoice, $application, $amount = 0)
    {
        $provider=$application->providers();
        if(is_null($provider))
            $provider=Organization::first();

        $item = [];
        $amount = (float)$amount;
        foreach ($application->pets as $pet) {
            $invOld = InvoiceItem::where('animal_id',$pet->id)->first();
            $treatId=$application->getTreatmentId($pet->id);
            if (!$invOld):
                $data = array(
                    'inv_id' => $invoice->id,
                    'client_id' => $invoice->client_id,
                    'provider_id' => $provider->id,
                    'application_id' => $application->id,
                    'treatment_id' => $treatId,
                    'vet_id' => 1,
                    'animal_id' => $pet->id,
                    'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                    'service_description' => 'Imported from CSV',
                    'amount_total' => $amount
                );
                array_push($item, $data);
            else:
                $data = array(
                    'inv_id' => $invoice->id,
                    'client_id' => $invoice->client_id,
                    'provider_id' => $provider->id,
                    'application_id' => $application->id,
                    'treatment_id' => $treatId,
                    'vet_id' => 1,
                    'animal_id' => $pet->id,
                    'service_date' => is_null($application->service_date) ? date('Y-m-d') : $application->service_date,
                    'service_description' => 'Imported from CSV',
                    'amount_total' => $amount
                );
                array_push($item, $data);
            endif;
        }
        if (count($item) > 0) {
            $this->model->insert($item);
        } else {
            throw new \Exception('Failed to generate invoice');
        }
        return $item;
    }

    /**
     * @param $application
     * @param $pet
     * @param $provider
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getRatePlan($application, $pet, $provider)
    {
        $planId = $provider->plan_id;
        $type = $provider->type;
        $data = DB::table('rates')
            ->join('rate_plan', 'rates.plan_id', 'rate_plan.id')
            ->join('rate_type', 'rates.rate_type_id', 'rate_type.id')
            ->join('treatments', 'rates.treatment_id', 'treatments.id')
            ->join('app_pet_treatment as apt', 'apt.treatment_id', 'treatments.id')
            ->join('pets', 'apt.pet_id', 'pets.id')
            ->select('pets.*', 'rates.cost', 'treatment_name', 'apt.vet_id', 'rate_metrics_type', 'rate_unit', 'rate_metrics')
            ->where([
                ['apt.application_id', $application->id],
                ['apt.pet_id', $pet->id],
            ])->where('rate_plan.is_active', 1)
            ->where(function ($query) use ($planId) {
                $query->where('rate_plan.id', $planId)->orwhere('rate_plan.is_custom', 1);
            })->where('rate_plan.type', $type)
            ->whereRaw("lower(pets.species)=lower(rates.animal_type)")
            ->whereRaw("lower(pets.sex)=lower(rates.sex)")->get();
        if (count($data) > 0)
            return $data;
        else
            throw new \Exception('Can\'t find rate');
    }

    /**
     * @param $application
     * @param $pet
     * @param $provider
     * @param $treatment
     * @return $this|\Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getRatePlanN($application, $pet, $provider, $treatment)
    {
        $planId = $provider->plan_id;
        $type = $provider->type;
        $data = DB::table('rates')
            ->join('rate_plan', 'rates.plan_id', 'rate_plan.id')
            ->join('rate_type', 'rates.rate_type_id', 'rate_type.id')
            ->join('treatments', 'rates.treatment_id', 'treatments.id')
            ->join('app_pet_treatment as apt', 'apt.treatment_id', 'treatments.id')
            ->join('pets', 'apt.pet_id', 'pets.id')
            ->select('pets.*', 'rates.cost', 'treatment_name', 'apt.vet_id', 'rate_metrics_type', 'rate_unit', 'rate_metrics')
            ->where([
                ['apt.application_id', $application->id],
                ['apt.pet_id', $pet->id],
            ])
            ->where(function ($query) use ($planId) {
                $query->where('rate_plan.id', $planId)->orwhere('rate_plan.is_custom', 1);
            })->where('rate_plan.type', $type)
            ->whereRaw("lower(pets.species)=lower(rates.animal_type)")
            ->whereRaw("lower(pets.sex)=lower(rates.sex)");

        if ($treatment != '')
            $data = $data->where('treatments.id', $treatment);

        $data = $data->get();
        if (count($data) > 0)
            return $data;
        else
            throw new \Exception('Please Perform Service First');
    }

    /**
     * @param $data
     * @param $compareString
     * @return bool
     */
    protected function performComparision($data, $compareString)
    {
        $list = ['<=', '==', '>'];
        foreach ($list as $l) {
            if (hasOperator($compareString, $l)) {
                $d = (int)str_replace($l, '', $compareString);
                if (is_int($d) && $d != 0) {
                    switch ($l) {
                        case '<':
                            return $data < $d;
                        case '<=':
                            return $data <= $d;
                        case '>':
                            return $data > $d;
                        case '>=':
                            return $data >= $d;
                        case '==':
                            return $data == $d;
                        default:
                            return false;
                    }
                } else
                    return false;

            }
        }
        return false;
    }


    public function storeLedger($invoice, $application)
    {

        $provider=$application->providers();
        if(is_null($provider))
            $provider=Organization::first();

        $led = new \App\Lib\Ledger(
            $invoice->getTable(),
            $invoice->id,
            $provider->id,
            $invoice->invoiceItems->sum('amount_total'),
            $invoice->id, 'invoice');
        $led->store();
    }

    /**
     * For insert ledger
     *
     * @param $invoice
     * @param $application
     * @param $amt
     */
    public function storeLedgerInv($invoice, $application, $amt)
    {
        $provider = $application->providers();

        $led = new \App\Lib\Ledger($invoice->getTable(), $invoice->id, $provider->id, $amt, $invoice->id, 'invoice');
        $led->store();
    }

    /**
     * For invoice update
     *
     * @param $invoice
     * @param $appId
     * @param $amt
     * @param $providerId
     * @param string $type
     */
    public function storeLedgerOnUpdate($invoice, $appId, $amt, $providerId, $type = 'cr')
    {
        $led = new \App\Lib\Ledger($invoice->getTable(), $invoice->id, $providerId, $amt, $invoice->id, 'invoice', $type);
        $led->store();
    }

    public function selectDataTableBatch(Request $request, $appId = null)
    {
        $role = auth()->user()->role;

        $perpage = $request->pagination['perpage'] == 0 ? 100000 : $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('invoice_batch')
            ->join('organization', 'organization.id', '=', 'invoice_batch.provider_id')
            ->select('invoice_batch.*', 'organization.cname');


        $result = $result->where('invoice_batch.is_deleted', 0);

        $requestData = $request->all();


        $filter = new InvoiceBatchFilter($request);
        if (isset($_COOKIE['invoice']) || isset($_COOKIE['invoice_quick'])) {
            $advData = isset($_COOKIE['invoice']) ? json_decode($_COOKIE['invoice']) : [];
            $openData = isset($_COOKIE['invoice_quick']) ? json_decode($_COOKIE['invoice_quick']) : [];
            $mergeData = array_merge($advData, $openData);
            $result = $filter->getQueryCookie($result, $mergeData);

        } else {
            $r = $request->all();
            if(!array_key_exists('query', $r) || (array_key_exists('query', $r) && $r['query']==null)){
                $start = date("Y-m-d", strtotime("first day of -2 month"));
                $end = date("Y-m-d", strtotime('last day of this month'));
                $result = $result->whereIn('invoice_batch.status', ['Not Paid'])->whereBetween('invoice_batch.invoice_batch_date', [$start, $end]);
            }else{
                if(array_key_exists('query', $r) && $r['query'] != null && array_key_exists('statusDate', $r['query'])){
                    $result = $filter->getQuery($result);
                }
            }
            $result = $filter->getQueryNormal($result);
        }


        $totalResult = $result->count();
        if (isset($request->sort['field'])){
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        }else{
            $result = $result->orderBy('invoice_batch_date', 'desc');
        }
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();

        $data = [
            'meta' => [
                'page' => (int)$request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int)$perpage,
                'total' => (int)$totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;

    }
    public function getBatchReportData(Request $request)
    {
        $sortField = $request->sort_field;
        if($sortField == ''){
            $sortField = 'alt_id';
        }
        $sortvalue = $request->sort_value;
        if($sortvalue == ''){
            $sortvalue = 'desc';
        }
        $result = DB::table('invoice_batch')
            ->join('organization', 'organization.id', '=', 'invoice_batch.provider_id')
            ->select('invoice_batch.*', 'organization.cname')->latest();


        $result = $result->where('invoice_batch.is_deleted', 0);


        $filter = new InvoiceBatchFilter($request);
        $result = $filter->getQueryNormal($result);

        return $result->orderBy($sortField, $sortvalue)->get();
    }
    public function getAllBatchDashboard(Request $request, $appId = null)
    {
        $role = auth()->user()->role;

        $perpage = $request->pagination['perpage'] == 0 ? 100000 : $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('invoice_batch')
            ->join('organization', 'organization.id', '=', 'invoice_batch.provider_id')
            ->select('invoice_batch.*', 'organization.cname');


        $result = $result->where('invoice_batch.is_deleted', 0);

        $requestData = $request->all();


        $filter = new InvoiceBatchFilter($request);
        if (isset($_COOKIE['invoice']) || isset($_COOKIE['invoice_quick'])) {
            $advData = isset($_COOKIE['invoice']) ? json_decode($_COOKIE['invoice']) : [];
            $openData = isset($_COOKIE['invoice_quick']) ? json_decode($_COOKIE['invoice_quick']) : [];
            $mergeData = array_merge($advData, $openData);
            $result = $filter->getQueryCookie($result, $mergeData);

        } else {
            $r = $request->all();
            if(!array_key_exists('query', $r) || (array_key_exists('query', $r) && $r['query']==null)){
                $start = date("Y-m-d", strtotime("first day of this month"));
                $end = date("Y-m-d", strtotime('last day of this month'));
                $result = $result->whereIn('invoice_batch.status', ['Not Paid'])->whereBetween('invoice_batch.invoice_batch_date', [$start, $end]);
            }else{
                if(array_key_exists('query', $r) && $r['query'] != null && array_key_exists('statusDate', $r['query'])){
                    $result = $filter->getQuery($result);
                }
            }
            $result = $filter->getQueryNormal($result);
        }

        $totalResult = $result->count();
        if (isset($request->sort['field'])){
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        }else{
            $result = $result->orderBy('invoice_batch_date', 'desc');
        }
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();

        $data = [
            'meta' => [
                'page' => (int)$request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int)$perpage,
                'total' => (int)$totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;

    }
}