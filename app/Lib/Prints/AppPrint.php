<?php


namespace App\Lib\Prints;


use App\Models\Application;
use DB;
use App\Models\Organization;
use App\Models\Client;
class AppPrint extends MainPrint implements Printable
{
    public function print($id)
    {
        $application = Application::find($id);
        $copayStatus = $application->copayStatus();

        $invoiceItem = $application->invoiceItem->first();

        if (!is_null($invoiceItem)) {
            $invoiceStatus = $invoiceItem->invoice->invoice_status;
            $invoice = $invoiceItem->invoice;
        } else {
            $invoiceStatus = "Approved";
            $invoice = '';
        }
        $treatments = [];
        foreach($application->pets as $pet):
            $pet->treatments = $application->appPetTreatment($pet->id);
            foreach($pet->treatments as $treatment):
                if(isset($treatment->vet_id)):
                    $pet->vet = Client::find($treatment->vet_id);
                endif;
            endforeach;
            $appPet = DB::table('application_pet')->where('application_id', $application->id)->where('pet_id', $pet->id)->first();
            if(isset($appPet->cert_number)):
            $pet->cert_number = $appPet->cert_number;
            endif;
            if(isset($appPet->provider_id)):
                $pet->provider = Organization::find($appPet->provider_id);
            endif;
        endforeach;
        $data = [
            'id' => $application->id,
            'client' => $application->client,
            'application_date' => date(sitedateformatphp(), strtotime($application->application_date)),
            'approved_date' => date(sitedateformatphp(), strtotime($application->approved_date)),
            'verified_agency' => $application->verified_agency_id,
            'application_status' => $application->status,
            'copay' => $copayStatus ? 'Paid' : 'Not Paid',
            'invoice' => number_format($application->invoiceItem->sum('amount_total'), 2),
            'payment' => number_format($application->payment()->sum('trans_amount'), 2),
            'invoicestatus' => $invoiceStatus,
            'source' => $application->source,
            'pets' => $application->pets,
            'application' => $application
        ];
        return $data;
        return Prints::mergePrint('app_print', $data);
    }
}