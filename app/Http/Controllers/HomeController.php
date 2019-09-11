<?php

namespace App\Http\Controllers;

use App\File;
use App\Lib\File\FileHandler;
use App\Repo\TimeSheetRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const DS = DIRECTORY_SEPARATOR;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (!Auth::viaRemember()) {
            $this->middleware('auth');
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutSettings = \DB::table('builder_setting')->get()->keyBy('setting_label')->toArray();

        return view('default.master', compact('layoutSettings'));

    }

    public function fileDownload(File $file)
    {
        try {
            $file = $file->file_name;
            $path = storage_path('uploads' . self::DS . $file);

            if (file_exists($path)):
                $headers = [
                    'Content-Description' => 'File Transfer',
                    'Content-Disposition' => 'attachment; filename="' . $file . '"',
                    'Content-Transfer-Encoding' => 'binary',
                    'Content-Type' => 'application/pdf',
                ];
                return response()->download($path, $file, $headers);

            else:
                return back()->with('fileError', 'File not Found');
            endif;
        } catch (\Exception $e) {
            return back()->with('fileError', 'File not Found');
        }

    }

    public function responseFile(File $file)
    {

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

    public function getFile($folder, $filename)
    {
        if ($folder !== "framework" && $folder !== "logs"):
            $path = storage_path($folder . DIRECTORY_SEPARATOR . $filename);
            $file = FileHandler::returnFile($path);
            return $file;
        endif;
        abort(404);
    }

    public function notFound()
    {
        return view('errors.404Page');
    }

    public function dashboard(Request $request)
    {
        return view('default.pages.dashboard2.index');
    }

    // table data
    public function getTableData(Request $request)
    {
        return (new TimeSheetRepo('Fgp\Timesheet'))
            ->selectDataTable($request);
    }
}
