<?php

namespace App\Repo;

use App\Lib\Filter\ScheduleFilter\ScheduleFilter;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ScheduleRepo extends BaseRepo
{
    public function __construct(?Schedule $model)
    {
        parent::__construct($model ?: new Schedule());
    }

    public function selectData()
    {
        $this->execute(function (Builder $query, $request) {

            $query->select([
                'schedules.id',
                DB::raw('date_format(schedules.date, "%m/%d/%Y") as date'),
                // DB::raw('time_format(schedules.time_in, "%h:%i %p") as time_in'),
                // DB::raw('time_format(schedules.time_out, "%h:%i %p") as time_out'),
                DB::raw('sum(time_to_sec(total_hrs)) / 3600 as total_hrs'),
            ]);
            $query->addSelect('courts.name as court', 'courts.id as court_id');
            // $query->addSelect('organizatio.name as court');
            $query->addSelect('address.add1', 'address.add2', 'address.city');

            $query->leftJoin('courts', 'courts.id', 'schedules.court_id');
            // $query->leftJoin('organizations', 'organizations.id', 'schedules.court_id');

            $query->leftJoin('address', function ($join) {
                $join->on('table_name', DB::raw("'courts'"));
                $join->on('table_id', 'courts.id');
            });

            $filter = new ScheduleFilter($request);
            $filter->getQuery($query);

            $query->where('schedules.is_deleted', 0)
                ->groupBy('courts.id');
        });

        $this->map(function ($model) {
            $model->total_hrs = format_hrs($model->total_hrs);
            return $model;
        });

        return $this->paginate();
    }
}
