<?php

namespace App\Http\Controllers\SiteSettings;

use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Lib\Exporter\TxtExporter;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\SiteSettingRequest;
use App\Repo\SiteSettingRepo;
use App\Models\SiteSettings;

class SiteSettingController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.site_settings';
    }

    /**
     * @param $model
     * @return SiteSettingRepo | null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new SiteSettingRepo($model);
        return self::$repo;
    }

    /**
     * @return view
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request)
    {
        $data = self::getInstance('SiteSettings')->selectDataTable($request);
        return $data;
    }

    /**
     * create form
     */
    public function create()
    {
        return view($this->clayout . '.modals.add');
    }

    /**
     * @param SiteSettingRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(SiteSettingRequest $request)
    {
        $res = self::getInstance('SiteSettings')->saveUpdate($request);
        if ($res) :
            return $this->response("Site Settings Added", "view", 200);
        else :
            return $this->response("Cant Added Site Settings", "view", 422);
        endif;
    }

    /**
     * @param SiteSettings $setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SiteSettings $setting)
    {
        return view($this->clayout . '.modals.edit', compact('setting'));
    }

    public function update(SiteSettingRequest $request, SiteSettings $setting)
    {
        $res = self::getInstance($setting)->saveUpdate($request);

        if ($res) :
            return $this->response("Site Settings updated", "view", 200);
        else :
            return $this->response("Cant update Site Settings", "view", 422);
        endif;
    }

    /**
     * @param SiteSettings $setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(SiteSettings $setting)
    {
        return view($this->clayout . '.modals.delete', compact('setting'));
    }

    /**
     * @param SiteSettings $setting
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function destroy(SiteSettings $setting)
    {
        $res = self::getInstance($setting)->softDelete();

        if ($res)
            return $this->response("Site Settings deleted successFully", "view", 200);
        else
            return $this->response("Can't delete Site Settings", 'view', 422);
    }

    public function emailMode()
    {
        $settings = SiteSettings::where('code', 'email_mode')->first();
        if ($settings->value == 'queue') {
            $settings->value = 'auto';
            $settings->save();
        } else {
            $settings->value = 'queue';
            $settings->save();
        }
        return $this->response("Email Mode Changed Successfully", "view", 200);
    }

    public function applicationMode($code)
    {
        $settings = SiteSettings::where('code', $code)->first();
        if ($settings->value == 'Modal') {
            $settings->value = 'page';
            $settings->save();
        } else {
            $settings->value = 'Modal';
            $settings->save();
        }
        return $this->response("Mode Changed Successfully", "view", 200);
    }

    public function notificationChange($code)
    {
        $settings = SiteSettings::where('code', $code)->first();
        if ($settings->value == 'True') {
            $settings->value = 'False';
            $settings->save();
        } else {
            $settings->value = 'True';
            $settings->save();
        }
        return $this->response("Settings Updated Successfully", "view", 200);
    }


    public function mailConfig($code)
    {
        $settings = $this->getSettings($code);

        if ($settings->code == 'email_mode') :
            if ($settings->value == 'queue') {
                $settings->value = 'auto';
            } else {
                $settings->value = 'queue';
            } else :

            if ($settings->value == 'false') {
                $settings->value = 'true';
            } else {
                $settings->value = 'false';
            }
        endif;
        $settings->useru_id = auth()->id();
        $settings->save();
        return $settings;
//        return $this->response("Mail Config  Changed Successfully", "view", 200);
    }

    protected function getSettings($code)
    {
        if ($settings = SiteSettings::where('code', $code)->first()) {
            return $settings;
        } else {
            $settings = new SiteSettings();
            $settings->code = $code;
            $settings->value = 'change';
            $settings->userc_id = auth()->id();
            $settings->save();
            return $settings;
        }
    }

    public function exportData(Request $request, $type)
    {
        $data = SiteSettings::select('code', 'value', 'description')->where('is_deleted', 0)->get();

        $fields = array('Name', 'Value', 'Description');
        $mapField = array('code', 'value', 'description');
        $data = cleaner($mapField, $data);
        $data['table'] = 'Report of Site Settings';

        if (count($data) > 0) {
            $export = $this->reportFactory($type, $fields, $data);
            $exporter = new \App\Lib\Exporter\Exporter($export);
            $filename = $exporter->export();
            return response()->download($filename)->deleteFileAfterSend(true);
        } {
            return 'No Data Available For Current Filter';
        }
    }

    /**
     * @param $type
     * @param $data
     * @return CSVExporter|JSONExporter|PDFExporter|TxtExporter
     * @throws \Exception
     */
    public function reportFactory($type, $fields, $data)
    {
        switch ($type) {
            case 'csv':
                return new CSVExporter($data, $fields, 'SiteSettingsReports');
                break;
            case 'json':
                return new JSONExporter($data);
                break;
            case 'txt':
                return new TxtExporter($data);
                break;
            case 'pdf':
                return new PDFExporter($data, $fields, 'print');
                break;
            default:
                throw new \Exception("Method Not Allowed " . $type);
                break;
        }
    }
}
