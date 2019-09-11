<?php


namespace App\Http\Controllers\Ledger;


use App\Http\Controllers\BaseController;
use App\Models\InvoiceItem;
use App\Models\Ledger;
use App\Models\Organization;
use App\Repo\LedgerRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerController extends BaseController
{

    /**
     * @var null
     */
    private static $repo = null;
    /**
     * @var string
     */
    private $clayout = '';

    /**
     * LedgerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.ledger.';
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $providers=Organization::where('is_deleted',0)->where('is_approved',1)->get();
        return view($this->clayout . 'index',compact('providers'));
    }

    /**
     * @param $model
     * @return LedgerRepo|null
     */
    private static function getInstance($model)
    {
        self::$repo = new LedgerRepo($model);
        return self::$repo;
    }

    public function balance()
    {
        $drTotal=Ledger::where('is_deleted',0)->sum('dr_amount');
        $crTotal=Ledger::where('is_deleted',0)->sum('cr_amount');
        $total=$drTotal-$crTotal;
        return array(
            'total'=>$total,
            'debit'=>$drTotal,
            'credit'=>$crTotal,
        );
    }

    public function getInvoiceDetails($pid=null)
    {

        $paid = DB::table('payment')
            ->join('invoice_line_item as item','item.inv_id','payment.inv_id');

        if (is_null($pid))
            $total = InvoiceItem::sum('amount_total');
        else {
            $total = InvoiceItem::whereIn('provider_id', $pid)->sum('amount_total');
            $paid = $paid->whereIn('item.provider_id', $pid);
        }

        $paid=$paid->groupBy('item.inv_id')->distinct()->sum('trans_amount');
        $unpaid = $total - $paid;
        return array(
            'total' => $total,
            'paid' => $paid,
            'unpaid' => $unpaid
        );
    }

    /***
     * @param Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
       return self::getInstance('ledger')->selectDataTable($request);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $client = self::getInstance('Ledger')->saveUpdate($request);
    }
}