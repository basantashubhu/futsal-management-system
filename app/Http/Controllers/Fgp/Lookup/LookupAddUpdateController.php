<?php

namespace App\Http\Controllers\Fgp\Lookup;

use App\Models\Fgp\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Config;

class LookupAddUpdateController extends BaseController
{
    /**
     * save section from fly
     * @param Request $request
     * @return LookupAddUpdateController|\Illuminate\Http\JsonResponse
     */
    public function saveSection(Request $request) {
        $this->validate($request, validation_value('lookup_section_form'));
        save_update(app(Section::class), [
            'section' => $request->input('section_name'),
            'desc' => $request->input('section_desc')
        ]);
        return $this->response('Section Added Successfully.', $request->input('section_name'), 200);
    }
}
