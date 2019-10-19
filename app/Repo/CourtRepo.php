<?php

namespace App\Repo;

use App\Lib\Filter\CourtFilter;
use App\Models\Court;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CourtRepo extends BaseRepo
{
    public function __construct(?Court $instance = null)
    {
        parent::__construct($instance ?? new Court());
    }

    public function selectData()
    {

        $this->execute(function (Builder $query, $request) {

            $query->select('courts.*');
            $query->addSelect('cell_phone as phone', 'email', 'url as website');
            $query->addSelect('add1', 'city');

            $query->leftJoin('contacts', function ($join) {
                $join->on('contacts.table_id', 'courts.id');
                $join->on('contacts.table_name', DB::raw('"courts"'));
            });
            $query->leftJoin('address', function ($join) {
                $join->on('address.table_id', 'courts.id');
                $join->on('address.table_name', DB::raw('"courts"'));
            });

            $filter = new CourtFilter($request);
            $filter->getQuery($query);

            $query->where('courts.is_deleted', 0);
        });

        return $this->paginate();
    }
}
