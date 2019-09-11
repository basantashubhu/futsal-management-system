<?php

//Route::get('/', 'HomeController@index')->name('default');
use App\Lib\Capture\ScreenCapture;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Storage;

Route::get('/printApp', function () {
    $view = view('default.print.print', ['datas' => array('table' => ''), 'fields' => []]);
    return $view;
    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('/notFound', 'HomeController@notFound');

Route::get('/dashboard', 'HomeController@dashboard');

Route::get('/dashboard1', function () {
    return view('default.pages.dashboard.index_option');
});
Route::get('/dashboard2', function () {
    return view('default.pages.dashboard.index');
});

Route::get('/calendar1', function () {
    return view('default.pages.calendar.calendar1');
});

Route::get('addEvent', function () {
    return view('default.pages.calendar.modal.addEvent');
});
Route::get('advancedSearch', function () {
    return view('default.pages.calendar.modal.advancedSearch');
});
Route::get('batchLoad', function () {
    return view('default.pages.calendar.modal.batchLoad');
});

Auth::routes();
Route::post('/login', 'User\LoginController@login');
Route::post('/session/logout', 'User\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mylogin', function () {
    return view('auth.mylogin');
});

Route::get('/login4', function () {
    return view('auth.login4');
})->middleware('guest');

Route::get('/create/login/{token}', 'Client\ClientRegistrationController@confirmEmail');
Route::post('/new/register/client', 'Client\ClientRegistrationController@sendEmail');

/**
 * PDF to thumb
 */
Route::post('/getPdfThumb', 'PDF\PDFController@index');

//for draggable
Route::get('demo', function () {
    return view('default.pages.draggable');
});

Route::get('/date', function () {
    $date = Date('Y-m-d');
    return formatDate($date);
});

Route::get('/error', function () {
    return view('default.errors.error1');
});

Route::get('/mysession', function () {
    return session('loggedin_id');
});

/*--------------file download---------------*/
Route::get('file/download/{file}', 'HomeController@fileDownload');
Route::get('file/response/{file}', 'HomeController@responseFile');

Route::get('/merge/template', function () {
    $data = array(
        'name' => 'prabhat',
    );
    $test = "<body text='{name}'>";
    $template = new \App\Lib\Template\TemplateMerge($test, $data);

    $template->merge();
    $temp = $template->getTemplate();
    return $temp;
});

/**
 * Temp Routes
 */
Route::get('/temp-np', function () {
    return view('default.pages.np.dashboard.index');
});

Route::get('/mailable', function () {
    $invoice = App\Models\Application::find(1);
    $invoice = $invoice->getAttributes();
    return new App\Mail\ApplicationChangedToReview($invoice);
});

Route::get('/test', function () {
    $path = 'D:\std\storage\uploads\9f12bcc8c2aa163b2d68374c63c40292.pdf';
    $abPath = storage_path('uploads' . DIRECTORY_SEPARATOR);
    $p = str_replace($abPath, '', $path);
    echo $p;
});

Route::get('/csv', function () {
    $converter = new \App\Lib\Importer\CsvImporter('Providers.csv');
    return $converter->convert()->getDatas();
});

//Not selected error
Route::get('notFoundError/{type}', function ($type) {
    return view('default.pages.error.notFoundError', compact('type'));
});

//for approval template
Route::get('approvalLetter', function () {
    $view = view('default.letters_template.approval_letter');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view, 'no_footer');

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});
//for non-profit certificate for surgery template
Route::get('npCertificateSurgery', function () {
    $view = view('default.letters_template.npCertificateSurgery');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

//for ie certificate for surgery template
Route::get('ieCertificateSurgery', function () {
    $view = view('default.letters_template.ieCertificateSurgery');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});
//for ie certificate for surgery with treatment template
Route::get('ieCertificateSurgeryTreatment', function () {
    $view = view('default.letters_template.ieCertificateSurgery_treatment');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

//for surgical certificate for surgery template
Route::get('surgicalProvider', function () {
    $view = view('default.letters_template.surgical_provider');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

//for surgery providers
Route::get('providers', function () {
    $view = view('default.letters_template.providers');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});
//for denial letter
Route::get('denialLetter', function () {
    $view = view('default.letters_template.denialLetter');
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

Route::get('providerList', function () {
    $providers = \App\Models\ProviderList::all();
    $view = view('default.print.providerList', compact('providers'));
    return $view;

    $screenCapture = new ScreenCapture();

    $path = $screenCapture->load($view);

    $filename = md5(uniqid()) . ".pdf";
    $headers = [
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Transfer-Encoding' => 'binary',
        'Content-Type' => 'application/pdf',
    ];
    return response()->download($path, $filename, $headers)->deleteFileAfterSend(true);
});

Route::get('/ieCert', function () {
    $application = \App\Models\Application::find(1921);
    $appRepo = new \App\Repo\ApplicationRepo($application);
    $data = $appRepo->getDetailsForSurgery();
    dd($data);
});

Route::get('/about/versions', function () {
    return view('default.pages.about.version');
});

Route::get('/demo/route', function () {
    sleep(5);
    return 'processing';
});
Route::get('/demo/check', function () {
    dd(email_app_review__mode());
});

Route::get('getVoluntersTodaysTimeSheet', function () {
    return view('default.fgp.volunteer.profile.calendar_data_view');
});
