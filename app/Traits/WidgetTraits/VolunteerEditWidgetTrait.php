<?php

namespace App\Traits\WidgetTraits;

use App\Http\Controllers\Fgp\Volunteer\VolunteerController;
use App\Models\Fgp\Template;
use App\Models\Fgp\Volunteer;
use App\Models\Fgp\VolunteerDetail;
use DB;
use Illuminate\Http\Request;

trait VolunteerEditWidgetTrait
{

    public function updateGenerals(Request $request, Volunteer $volunteer)
    {

        // vol address
        $this->validate($request, [
            'add1' => "required",
            "first_name" => "required",
            "last_name" => "required",
            "city" => "required",
            "state" => "required",
            "zip" => "required",
            "alt_id" => "required",
        ]);

        // vol contact
        $this->validate($request, [
            'number.*' => 'nullable|regex:/^\(([\d]{3})\) ([\d]{3})-([\d]{4})$/',
            'email' => 'nullable|email',
        ]);

        $this->volGenerals($request, $volunteer);

        $this->volDob($request, $volunteer);

        $this->volAddress($request, $volunteer, $volunteer);

        $this->volContact($request, $volunteer, $volunteer);

        return response(["message" => "Volunteer Updated"], 200);
    }

    public function updateDetails(Request $request, Volunteer $volunteer)
    {
        try {

            $details = $request->only([
                'vendor_id', 'stipend_rate', 'eto_balance', 'payment_code', 'department', 'id_type', 'id_expiry', 'physical_exam_date', 'id_number',
            ]);
            foreach ($details as $code => $value) {
                $existingDetail = $volunteer->details->where('code', $code)->where('is_deleted', 0)->first();

                if ($existingDetail) {
                    $existingDetail->update(['value' => $value]);
                } else {

                    $newDetail = new VolunteerDetail;

                    $newDetail->create([
                        'label' => $this->create_label_from_code($code),
                        'code' => $code,
                        'value' => $value,
                        'volunteer_id' => $volunteer->id,
                    ]);
                }
            }

            $current_selectSites = $request->input("site_id", []);
            $current_selectSites = array_unique($current_selectSites);
            $newArray = [];
            if (array_key_exists('default_site', $request->all())) {
                foreach ($current_selectSites as $key => $site) {
                    if ($site === $request->default_site) {
                        $newArray[$site] = ['is_default' => 1];
                    } else {
                        $newArray[$site] = ['is_default' => 0];
                    }
                }
            }
            $volunteer->sites()->sync($newArray);

            $volGenerals = $request->only([
                'expense_eligibility',
            ]);

            $volGenerals['hired_date'] = $request->hired_date ? date('Y-m-d', strtotime($request->hired_date)) : null;

            self::getRepo($volunteer)->saveUpdate($volGenerals);

            DB::commit();
            return response(["message" => "Volunteer Updated"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(["message" => $e->getMessage()], 500);
        };
    }

    public function updateWidgetTemplate(Request $request, Volunteer $volunteer, Template $template = null)
    {

        $volunteerController = new VolunteerController;

        if ($request->time_type && $template) {

            $volunteerController->volunteerTemplateUpdate($request, $volunteer, $template);
        } else if ($request->time_type && !$template) {

            $volunteerController->storeTemplateVolunteer($request, $volunteer);
        } else {

            return;
        }
    }

    private function volDob(Request $request, Volunteer $volunteer)
    {

        $dobCode = "dob";
        $value = $request->input('dob', '');

        $existingDob = $volunteer->details->where('code', $dobCode)->where('is_deleted', 0)->first();

        if ($existingDob) {
            $existingDob->update(['value' => $value]);
        } else if ($value) {

            $newDetail = new VolunteerDetail;

            $newDetail->create([
                'label' => $this->create_label_from_code($dobCode),
                'code' => $dobCode,
                'value' => $value,
                'volunteer_id' => $volunteer->id,
            ]);
        }
    }
}
