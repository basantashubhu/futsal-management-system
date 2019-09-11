<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ValidationRequest;
use App\Models\Fgp\Section;
use App\Models\Settings\Validation;
use App\Repo\ValidationRepo;
use Illuminate\Http\Request;

class ValidationController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.validation';
    }
    /**
     * @param $model
     * @return LookupRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null) {
            self::$repo = new ValidationRepo($model);
        }

        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $sections = app()->make(Section::class)->get();
        $v_sections = Validation::select('section', 'id')->groupBy('section')->get();

        $section = $sections->first() ?: $v_sections->first();
        if (!$section) {
            throw new \Exception('Section not configured.');
        }

        $codes = Validation::where('section', $section->section)->get();
        return view($this->clayout . '.index', compact('codes', 'sections', 'section', 'v_sections'));
    }
    public function singleView($sections)
    {
        $section = Section::where('section', $sections)->first();
        if (!$section) {
            $section = Validation::where('section', $sections)->first();
        }
        $codes = Validation::where('section', $sections)->get();
        return view($this->clayout . '.includes.singleView', compact('codes', 'section'));
    }

    /**
     * Create Form
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = null)
    {
        if ($id) {
            $section = app()->make(Section::class)->find($id);
            if ($section) {
                $section = $section->section;
            }

        } else {
            $section = null;
        }

        return view($this->clayout . '.modal.add', compact('section'));
    }
    /**
     * @param ValidationRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(ValidationRequest $request)
    {
        $res = self::getInstance('Settings\Validation')->saveUpdate($request);

        if ($res) {
            return $this->response("Validation Added SuccessFully", "view", 200);
        } else {
            return $this->response("Can't Add Validation", 'view', 422);
        }
    }
    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request)
    {
        $data = self::getInstance('Settings\Validation')->selectDataTable($request);
        return $data;
    }
    /**
     * Update Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Validation $validation)
    {
        $sections = app()->make(Section::class)->get();
        return view($this->clayout . '.modal.edit', compact('validation', 'sections'));
    }

    public function update(ValidationRequest $request, Validation $validation)
    {
        $res = self::getInstance($validation)->saveUpdate($request);

        if ($res) {
            return $this->response("Validation Updated SuccessFully", "view", 200);
        } else {
            return $this->response("Can't Update Validation", 'view', 422);
        }
    }

    /**
     * code lookup in validation table
     * @param Request $request
     * @param         $section
     * @param null    $code
     * @return
     */
    public function code(Request $request, $section, $code = null)
    {
        return Validation::select('code as value', 'code as id')
            ->when($code, function ($query) use ($code) {
                $query->where('code', 'like', "%$code%");
            })->when($section != 'oooo', function ($query) use ($section) {
            $query->where('section', $section);
        })->get();
    }
}
