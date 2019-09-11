<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\SupportRequest;
use App\Models\User;
use App\Repo\SupportRepo;
use App\Models\Support;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Settings\Lookups;
use App\Lib\File\FileUploader;
use App\File;

class SupportController extends BaseController
{

    private static $repo = null;

    /**
     * @param $model
     * @return SupportRepo|null
     */
    private static function getInstance($model)
    {
        self::$repo = new SupportRepo($model);
        return self::$repo;
    }

    public function index()
    {
        $supports = Support::where('is_deleted', false)->latest()->limit(10)->get();
        $support = Support::where('is_deleted', false)->latest()->first();
        $types = Lookups::where('code', 'support_type')->get();
        if(isset($support->id))
            $file = File::where('table', 'supports')->where('table_id', $support->id)->first();

        return view('default.support.index', compact('supports', 'support', 'types', 'file'));
    }

    public function getAll(Request $request)
    {
        $data = self::getInstance('Support')->selectDataTable($request);
        return $data;
    }

    public function addSupport()
    {
        return view('default.support.crud.create');
    }

    public function storeSupport(SupportRequest $request)
    {
        try {
            $supports = $request->except('file');
            $supports['owner_id'] = auth()->id();
            $supports['status'] = 'New';
            $supports['support_type'] = 'Error';
            $supports['support_category'] = 'Support';
            $supports['support_department'] = 'Development';
            $support = self::getInstance('Support')->saveUpdate($supports);
            $support->assigned()->attach(User::first());

            if($request->hasFile('file')){
                $file = array();
                $fileName = $this->uploadAttachmentSingle($request->file());
                $repo = self::getInstance('Support');
                array_push($file, $fileName);
                $fileTitle = $request->title;
                $res = $repo->storeUploadedFilePath($file, $support, $fileTitle, 'upload', 'File');
            }

            return $this->response("Support added Successfully", ['support_id' => $support->id], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function uploadAttachmentSingle($file)
    {
        $fname = FileUploader::upload($file['file']);
        return $fname;
    }

    public function update(SupportRequest $request, $id)
    {
        $support = Support::find($id);
        $support = self::getInstance($support)->saveUpdate($request->except('files'));
        return $this->response("Support Edited Successfully", ['support_id' => $support->id], 200);
    }


    public function viewSingle($id)
    {
        $support = Support::find($id);
        $file = File::where('table', 'supports')->where('table_id', $id)->first();
        return view('default.support.includes.viewSingle', compact('support', 'file'));
    }

    public function editSupport($id)
    {
        $support = Support::find($id);
        return view('default.support.crud.edit', compact('support'));
    }

    public function deleteSupport($id)
    {
        $support = Support::find($id);
        return view('default.support.crud.delete', compact('support'));
    }

    public function destroySupport(Support $support)
    {
        $support->is_deleted = true;
        $support->save();
        return $this->response("Support Deleted Successfully", "view", 200);
    }

    public function viewFile($id)
    {
        $file = File::find($id);
        if ($file->count()) {
            if (file_exists(storage_path('uploads/' . $file->file_name))) {
                if (($file->fileInfo("extension") != "jpg" || $file->fileInfo("extension") != "jpeg" || $file->fileInfo("extension") != "png")) {
                    return response()->file(storage_path('uploads/' . $file->file_name));
                } else {
                    return response()->file(storage_path('uploads/' . $file->file_name));
                }
            } else {
                return back();
            }
        }
    }

    public function urlView($id)
    {
        $support = Support::find($id);
        $file = File::where('table', 'supports')->where('table_id', $id)->first();
        return view('default.support.includes.urlView', compact('support', 'file'));
    }

}
