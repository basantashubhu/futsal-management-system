<?php

namespace App\Repo;

use App\Lib\Filter\OrganizationFilter\OrganizationFilter;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\OrganizationDetal;
use Illuminate\Http\Request;

class OrganizationRepo extends BaseRepo
{
    public function __construct(?Organization $instance = null)
    {
        parent::__construct($instance ?? new Organization());
    }

    public function select2()
    {
        $this->execute(function ($query, $request) {
            $query->select('id', 'name as text');

            $filter = new OrganizationFilter($request);
            $filter->getQueryNormal($query);

            $query->where('organizations.is_deleted', 0);
        });

        return $this->get();
    }

    public function saveDetails(Request $request)
    {
        return $this->model->details()->save(new OrganizationDetal([
            'code' => 'lic_no', 'value' => $request->input('lic_no'),
        ]));
    }

    public function saveAddress(Request $request)
    {
        return $this->model->address()->save(new Address(
            $request->only('add1', 'add2', 'city', 'state') + [
                'zip_code' => $request->input('zip'),
            ]
        ));
    }

    public function saveContact(Request $request)
    {
        return $this->model->contact()->save(new Contact([
            'cell_phone' => $request->input('phone'),
            'email' => $request->input('company_email'),
            'url' => $request->input('url'),
        ]));
    }
}
