<?php

namespace App\Repo;

use App\Lib\Filter\OrganizationFilter\OrganizationFilter;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\OrganizationDetal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationRepo extends BaseRepo
{
    public function __construct(?Organization $instance = null)
    {
        parent::__construct($instance ?? new Organization());
    }

    public function select2()
    {
        $this->execute(function (Builder $query, $request) {
            $query->select('id', 'name as text');

            $filter = new OrganizationFilter($request);
            $filter->getQueryNormal($query);

            $query->where('organizations.is_deleted', 0);
        });

        return $this->get();
    }

    public function selectData()
    {
        $this->execute(function (Builder $query, $request) {
            $query->select('organizations.id', 'name', 'industry');

            $query->addSelect('cell_phone as phone', 'email', 'url as website');

            $query->addSelect('add1', 'city');

            $query->leftJoin('contacts', function ($join) {
                $join->on('contacts.table_id', 'organizations.id');
                $join->on('contacts.table_name', DB::raw('"organizations"'));
            });
            $query->leftJoin('address', function ($join) {
                $join->on('address.table_id', 'organizations.id');
                $join->on('address.table_name', DB::raw('"organizations"'));
            });

            $filter = new OrganizationFilter($request);
            $filter->getQuery($query);

            $query->where('organizations.is_deleted', 0);
        });

        return $this->paginate();
    }

    public function saveDetails(Request $request)
    {
        return $this->model->details()->save(new OrganizationDetal([
            'code' => 'lic_no', 'value' => $request->input('lic_no'),
        ]));
    }

    public function updateDetails(Request $request)
    {
        $detail = $this->model->details('lic_no');
        if (!$detail) {
            $detail = new OrganizationDetal([
                'code' => 'lic_no', 'value' => $request->input('lic_no'),
            ]);
            $this->model->details()->save($detail);
        } else {
            $detail->update([
                'value' => $request->input('lic_no'),
            ]);
        }
        return $detail;
    }

    public function saveAddress(Request $request)
    {
        return $this->model->address()->save(new Address(
            $request->only('add1', 'add2', 'city', 'state') + [
                'zip_code' => $request->input('zip'),
            ]
        ));
    }

    public function updateAddress(Request $request)
    {
        $address = $this->model->address;
        if (!$address) {
            $address = new Address($request->only('add1', 'add2', 'city', 'state') + [
                'zip_code' => $request->input('zip'),
            ]);
            $this->model->address()->save($address);
        } else {
            $address->update($request->only('add1', 'add2', 'city', 'state') + [
                'zip_code' => $request->input('zip'),
            ]);
        }
        return $address;
    }

    public function saveContact(Request $request)
    {
        return $this->model->contact()->save(new Contact([
            'cell_phone' => $request->input('phone'),
            'email' => $request->input('company_email'),
            'url' => $request->input('url'),
        ]));
    }

    public function updateContact(Request $request)
    {
        $contact = $this->model->contact;
        if (!$contact) {
            $contact = new Contact([
                'cell_phone' => $request->input('phone'),
                'email' => $request->input('company_email'),
                'url' => $request->input('url'),
            ]);
            $this->model->contact()->save($contact);
        } else {
            $contact->update([
                'cell_phone' => $request->input('phone'),
                'email' => $request->input('company_email'),
                'url' => $request->input('url'),
            ]);
        }
        return $contact;
    }
}
