<?php

namespace App\Http\Controllers\Court;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Court;
use App\Repo\CourtRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourtStoreController extends Controller
{
    static $repo;

    public static function createInstance($model = null)
    {
        return static::$repo = new CourtRepo($model);
    }

    public function validateCourtReq(Request $request)
    {
        $rules = validation_value('court_form');
        $request->validate($rules);
    }

    public function store(Request $request)
    {
        $this->validateCourtReq($request);
        DB::beginTransaction();
        try {
            $courtData = $request->only('name', 'organization_id');
            $address = $request->only('add1', 'add2', 'city', 'zip_code', 'state');
            $contact = $request->only('email', 'cell_phone', 'url');

            $court = static::createInstance()->saveUpdate($courtData);

            $court->address()->save(new Address($address));
            $court->contact()->save(new Contact($contact));

            DB::commit();

            return response(['data' => $court, 'message' => 'Court added successfully.'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['errors' => ['message' => $th->getMessage()]], 422);
        }
    }

    public function update(Request $request, Court $court)
    {
        $this->validateCourtReq($request);
        DB::beginTransaction();
        try {
            $courtData = $request->only('name', 'organization_id');
            $addressData = $request->only('add1', 'add2', 'city', 'zip_code', 'state');
            $contactData = $request->only('email', 'cell_phone', 'url');

            $court = static::createInstance($court)->saveUpdate($courtData);

            if ($address = $court->address) {
                $address->update($addressData);
            } else {
                $court->address()->save(new Address($addressData));
            }

            if ($contact = $court->contact) {
                $contact->update($contactData);
            } else {
                $court->contact()->save(new Contact($contactData));
            }

            DB::commit();

            return response(['data' => $court, 'message' => 'Court updated successfully.'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['errors' => ['message' => $th->getMessage()]], 422);
        }
    }
}
