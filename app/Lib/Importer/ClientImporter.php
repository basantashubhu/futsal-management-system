<?php


namespace App\Lib\Importer;


use App\Http\Controllers\Client\ClientController;
use App\Http\Requests\ClientRequest;
use App\Lib\Log\Log;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ClientImporter implements Importable
{
    private $datas;

    protected function makeRequestObject(Array $array)
    {
        $request = new Request($array);
        $request->setMethod('POST');
        return $request;
    }

    public function __construct(Array $datas)
    {
        $this->datas = $datas;
//        ini_set('max_execution_time', 8000);
    }

    public function import()
    {
        $count = 0;
        $reqobj = $this->ImportMapper();

        foreach ($reqobj as $client) {
            $this->importClient($this->makeRequestObject($client));

        }
        return $reqobj;
    }

    public function importClient(Request $request)
    {
        $client = $request->only('title', 'fname', 'mname', 'lname', 'personal_email', 'cell_phone', 'alt_id');
        try {
            if (!$this->checkIfPhoneExist($client['cell_phone']))
            {
                $clientData = $request->only('add1', 'add2', 'zip', 'city', 'state');
                $client['add1'] = $clientData['add1'];
                if ($request->exists('add2'))
                    $client['add2'] = $clientData['add2'];
                $client['zip'] = $clientData['zip'];
                $client['city'] = $clientData['city'];

                if (array_key_exists('state', $clientData))
                    $client['state'] = $clientData['state'];

                $client['is_imported'] = true;

                $client = new ClientRequest($client);
                $client = (new ClientController())->store($client, true);

                if ($client instanceof MessageBag)
                    return response(['message' => 'the given data was invalid', 'errors' => $client], 422);
                elseif ($client instanceof \Exception)
                    throw new \Exception($client);

                $data = $this->prepareLog($request->alt_id, 'Client Inserted Successfully' . json_encode($request->all()));
                $this->saveToLog($data, 'Client' . date('Y-m-d'), ['importer', 'success']);
            }
        } catch (\Exception $e) {
            $message = json_encode($e->getMessage()) . PHP_EOL . json_encode($request->all());
            $data = $this->prepareLog($request->alt_id, $message, 'error');
            $this->saveToLog($data, 'Client ' . date('Y-m-d'), ['importer', 'error']);
            return $this->response("Application Can't submitted", 'view', 422);

        }
    }

    private function checkIfPhoneExist($phone)
    {
        $c=Contact::where('cell_phone',$phone)->orWhere('phone',$phone)->first();
        return $c?true:false;
    }
    public function saveToLog($data, $name = 'Client', $folder = [])
    {
        (new Log())->save($data, $name, $folder);
        return true;
    }

    protected function prepareLog($id, $message, $status = 'success')
    {

        $data = "Client no : $id " . PHP_EOL . "
           ---------------------------------------------" . "
           $message" . "
           **********************************************" . "
           Status = $status" . "
           ----------------------------------------------" . PHP_EOL;
        return $data;
    }

    protected function ImportMapper()
    {
        $array = $this->datas;
        $newarray = array();
        foreach ($array as $a) {
            $test = array();
            foreach ($this->Mapper() as $key => $value) {
                if (array_key_exists($key, $a)) {
                    if ($value == 'dob') {
                        $test[$value] = date('Y-m-d', strtotime($a[$key]));
                    } else {
                        $test[$value] = $a[$key];
                    }
                }
            }
            $test['personal_email'] = 'client_kkc' . random_string() . '@zeuslogic.com';
            $test['state'] = 'De';
            array_push($newarray, $test);
        }
        return $newarray;
    }

    private function Mapper()
    {
        return array(
            'ID' => 'alt_id',
            'Vet Lic .' => 'vet_lic',
            'First Name' => 'fname',
            'Last Name' => 'lname',
            'Street Address' => 'add1',
            'City' => 'city',
            'Zip Code' => 'zip',
            'Cell Phone' => 'cell_phone',
            'Home Phone' => 'alt_phone',
            'Social Security (last 4)' => 'ssn',
            'Birth Date' => 'dob',
        );

    }

    public function response($message, $data, $statusCode = 200, $header = null)
    {
        $successError = null;

        if ($statusCode >= 200 && $statusCode <= 226)
            $successError = 'success';
        else {
            $successError = 'error';
            $statusCode = 500;
        }


        $arrStatus = ['type' => $successError, 'data' => $message, 'element' => $data];
        //$arrView = ['type' => 'view', 'data' => $data];

        if (is_array($header))
            return response()->json([$arrStatus], $statusCode)->withHeaders($header);
        else
            return response()->json([$arrStatus], $statusCode);
    }
}