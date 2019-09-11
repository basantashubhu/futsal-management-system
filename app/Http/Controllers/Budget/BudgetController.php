<?php


namespace App\Http\Controllers\Budget;


use App\Http\Controllers\BaseController;
use App\Repo\BudgetRepo;
use Illuminate\Http\Request;
use App\Models\Budget;


class BudgetController extends BaseController
{

    private static $repo=null;
    private $clayout;
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.budget.';
    }

    /**
     * @param $model
     * @return BudgetRepo|null
     */
    private static function getInstance($model)
    {
        if(self::$repo==null)
            self::$repo=new BudgetRepo($model);
        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout.'index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
        return self::getInstance('Budget')->selectDataTable($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addFund()
    {
        return view($this->clayout.'modal.add');
    }

    /**
     * @param Request $request
     * @return BudgetController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $request->validate([
           'budget_date'=>'required|date',
           'particulars'=>'required',
           'ref_no'=>'required',
            'dr_amount'=>'required'
        ]);
        $data=$request->all();
        $data['budget_date']=$request->has('budget_date')?date('Y-m-d',strtotime($request->budget_date)):date('Y-m-d');
        $data['table_name']='govt';
        $data['table_id']='0';
        $data['ref_type']='Voucher';
        
        $res=self::getInstance('budget')->saveUpdate($data);
        if($res):
            $b = new Budget();
            $b1 = $b->checkBalance();
            return $this->response('Fund Added Successfully',['balance'=>$b1],200);
        else:
            return $this->response('Failed To Add Fund','view',500);
        endif;

    }

    /**
     * @param Budget $budget
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit(Budget $budget)
    {
        if($budget->table_name=='govt')
            return view($this->clayout.'modal.edit',compact('budget'));
        else
            return $this->response('Can\'t edit the Details',500);

    }

    /**
     * @param Request $request
     * @param Budget $budget
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Budget $budget)
    {
        $res=self::getInstance($budget)->saveUpdate($request);
        if($res)
            return $this->response('Fund Updated Successfully',$budget,200);
        else
            return $this->response('Failed To Update Fund','view',500);
    }
}