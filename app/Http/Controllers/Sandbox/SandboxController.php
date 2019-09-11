<?php


namespace App\Http\Controllers\SandBox;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\RatePlan;

class SandBoxController extends BaseController
{
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.sandbox.';
    }

    public function applicationDetail()
    {
    	return view($this->clayout.'applicationDetail');
    }

    public function addTreatmentPlan($petId)
    {
        return view($this->clayout.'application.detail.includes.addTreatmentPlan');
    }

    public function uploadFile()
    {
        return view($this->clayout.'application.detail.includes.uploadFile');
    }

    public function applicationNPDetail()
    {
        $rate_plans = RatePlan::where('is_deleted', false)->get();
        return view($this->clayout.'np', compact('rate_plans'));
    }

    public function nonProfitStatus(Request $request)
    {
        if($request->approve == "false"):
            return view($this->clayout.'np.steps.step-3');
        else:
            return view($this->clayout.'np.steps.step-2');
        endif;
    }
    public function nonProfit_appDenial(Request $request)
    {
        return view($this->clayout.'np.steps.denial_sent');
    }

    public function nonProfitStatus_invoice(Request $request)
    {
        return view($this->clayout.'np.steps.step-4');
    }

    public function nonProfit_payment(Request $request)
    {
        if($request->approve == "false"):
            return view($this->clayout.'np.steps.invoice_denial');
        else:
            return view($this->clayout.'np.steps.step-5');
        endif;
    }

    public function addNp()
    {
        $rate_plans = RatePlan::where('is_deleted', false)->get();
        return view($this->clayout. 'np.modal.add', compact('rate_plans'));
    }

    /**
     * Method for mdatatable dummy
     */
    public function tableDemo()
    {
        return view($this->clayout.'.table.index');
    }

    /**
     * Method for agreement dummy
     */
    public function agreementDemo()
    {
        return view($this->clayout.'np');
    }
}
