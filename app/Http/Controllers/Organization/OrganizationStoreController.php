<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Repo\OrganizationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationStoreController extends Controller
{
    static $repo;

    public static function createInstance($model = null)
    {
        return static::$repo = new OrganizationRepo($model);
    }

    public function store(Request $request)
    {
        $this->validateOrg($request);
        $repo = static::createInstance();

        DB::beginTransaction();
        try {

            $org = $repo->saveUpdate([
                'name' => $request->input('cname'),
            ]);

            $repo->saveDetails($request);
            $repo->saveAddress($request);
            $repo->saveContact($request);

            DB::commit();

            return response(['data' => $org, 'message' => 'Organization added successfully.'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['errors' => [
                'message' => $th->getMessage() . ' ' . $th->getFile() . ':' . $th->getLine(),
            ]], 422);
        }
    }

    protected function validateOrg(Request $request)
    {
        $rules = validation_value('organization_form');
        $request->validate($rules);
    }
}
