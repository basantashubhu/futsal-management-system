<?php

namespace App\Services;

use App\Lib\File\FileUploader;
use App\Models\Fgp\PayPeriod;
use App\Models\Fgp\Site;
use App\Models\Fgp\TimesheetFile;
use App\Models\Fgp\Volunteer;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use RuntimeException;

class FileService{

	protected const TIMESHEET_DOC_STORAGE_LOCATION = 'uploads/timesheetsDocs';

	protected const VOLUNTEER_DOC_STORAGE_LOCATION = 'uploads/timesheetsDocs';

	private $fileUploader;

	/**
	 * Init fileuploader
	 * @param FileUploader $fileUploader [description]
	 */
	public function __construct(FileUploader $fileUploader){

		$this->fileUploader = $fileUploader;

	}

	/**
	 * Store Documents on Files Table
	 * @param  Request $request   [description]
	 * @param  Volunteer  $volunteer [description]
	 * @return Volunteer             [description]
	 */
	public function storeDocuments(Request $request, $volunteer){

	    $docs = $this->formatDocuments($request);

	    $file_name = [];
	    $file_title = [];

	    foreach ($docs as $key => $document) {
	        $file_name[] = $this->fileUploader::upload($document['document'], false, static::VOLUNTEER_DOC_STORAGE_LOCATION);
	        $file_title[] = $document['name'];
	    }
	    $this->storeUploadedFilePath($file_name, $volunteer, $file_title);

	}

	/**
	 * Store TimesheetFiles
	 * @param  Request   $request   
	 * @param  Volunteer $volunteer 
	 * @param  PayPeriod $period    
	 * @param  Site    $site      
	 * @return Integer               
	 */
	public function storeTimesheetFiles(Request $request, Volunteer $volunteer, PayPeriod $period, ?Site $site = null) : int{

		$docs = $this->formatDocuments($request);

		$file_name = [];

		$file_title = [];

		foreach ($docs as $key => $document) {
		    $file_name[] = FileUploader::upload($document['document'], false, static::TIMESHEET_DOC_STORAGE_LOCATION);
		    $file_title[] = $document['name'];
		}

		$this->storeTimesheetUploadedFiles($file_name, $volunteer, $file_title, "", "", $period, $site);

		return count($file_name);

	}

	/**
	 * Format Documents array
	 * @param  Request $request [description]
	 * @return Array           [description]
	 */
	protected function formatDocuments(Request $request){

	    $doc = [];

	    foreach ($request->documents as $key => $document) {
	        $doc[$key]['name'] = $request->document_name[$key];
	        $doc[$key]['document'] = $document;
	    }

	    return $doc;

	}

	/**
	 * Store uploaded file to files table
	 * @param  string $fileName         [description]
	 * @param  Volunteer $volunteer        [description]
	 * @param  string $fileTitle        [description]
	 * @param  string $document_segment [description]
	 * @param  string $document_type    [description]
	 * @return Void                     [description]
	 */
	protected function storeUploadedFilePath($fileName, $volunteer, $fileTitle, $document_segment = "", $document_type = "")
	{
	    $fileData = array();
	    $count = 0;
	    foreach ($fileName as $file) {

	        $data = array(
	            'table' => $volunteer->getTable(),
	            'table_id' => $volunteer->id,
	            'document_segment' => $document_segment != "" ? $document_segment : 'upload',
	            'document_type' => $document_type != "" ? $document_type : 'file',
	            'document_title' => is_array($fileTitle) ? (isset($fileTitle[$count]) ? $fileTitle[$count] : "title") : $fileTitle,
	            'file_name' => $file,
	            'created_at' => date('Y-m-d H:i:s')
	        );
	        array_push($fileData, $data);
	        $count++;
	    }
	    \App\File::insert($fileData);
	}

	/**
	 * Store Timesheet Uploaded Files To timesheet_files
	 * @param  Array     $fileName         [description]
	 * @param  Volunteer $volunteer        [description]
	 * @param  Array     $fileTitle        [description]
	 * @param  string    $document_segment [description]
	 * @param  string    $document_type    [description]
	 * @param  PayPeriod $period           [description]
	 * @param  Site      $site             [description]
	 * @return Void                        [description]
	 */
	protected function storeTimesheetUploadedFiles(
		Array $fileName, 
		Volunteer $volunteer, 
		Array $fileTitle,
		string $document_segment = "", 
		string $document_type = "",
		PayPeriod $period,
		?Site $site = null
	) : void{
	    $fileData = array();
	    $count = 0;

	    foreach ($fileName as $file) {

	        $data = array(
	            'document_segment' => $document_segment != "" ? $document_segment : 'upload',
	            'document_type' => $document_type != "" ? $document_type : 'file',
	            'document_title' => is_array($fileTitle) ? (isset($fileTitle[$count]) ? $fileTitle[$count] : "title") : $fileTitle,
	            'file_name' => $file,
	            'created_at' => date('Y-m-d H:i:s'),
	            'volunteer_id'	=> $volunteer->id,
	            'period_id'	=> $period->id,
	            'site_id'	=> $site->id ?? $site,
	            'userc_id'	=> auth()->id()
	        );
	        array_push($fileData, $data);
	        $count++;
	    }

	    DB::transaction(function() use($fileData) {

	    	\App\Models\Fgp\TimesheetFile::insert($fileData);

	    });
	}

	/**
	 * Fetch All the Timesheet Files
	 * @param  Volunteer $volunteer 
	 * @param  PayPeriod $period    
	 * @param  Site      $site      
	 * @return Collection|TimesheetFile               
	 */
	public function getTimesheetFiles(Volunteer $volunteer, PayPeriod $period, ?Site $site = null) : Collection{

		return TimesheetFile::where([
		    'volunteer_id' => $volunteer->id,
		    'period_id'     => $period->id,
		])->when($site, function($query) use ( $site ){
			$query->where('site_id', $site->id);
		})->get();

	}

	public function viewFile($filename, $location){


		if(file_exists(storage_path($location). $filename)){
			return response()->file(storage_path($location).$filename);

		}else{
			throw new RuntimeException("Sorry {$filename} doesn't exits");
		}


	}

	public function downloadFile($filename, $location){

		if(file_exists(storage_path($location). $filename)){
			return response()->download(storage_path($location).$filename);

		}else{
			throw new RuntimeException("Sorry {$filename} doesn't exits");
		}


	}


}