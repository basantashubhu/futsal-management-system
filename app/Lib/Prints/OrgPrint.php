<?php


namespace App\Lib\Prints;


use App\Models\Organization;

class OrgPrint extends MainPrint implements Printable
{
    public function print($id)
    {
        if ($org = Organization::find($id)) {
            $address = $org->address;
            $data = [
                'id' => $org->id,
                'cname' => $org->cname,
                'add1' => $address->add1,
                'city' => $address->zip->city,
                'state' => $address->zip->state,
                'zip' => $address->zip->zip_code
            ];
            $print = Prints::mergePrint('org_print', $data);
            return $print;
        }

        throw new \Exception('Error! Trying to get object that doesnot exists');
    }
}