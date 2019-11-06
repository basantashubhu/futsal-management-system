<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder as IlluminateBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleStoreController extends Controller
{
    public function storeTimesheet(Request $request)
    {
        $formattedData = $this->bulkDataFormatter($request->except('_token', 'court_id', 'timesheet_id', 'cal_date'));
        // dd($formattedData);
        $errors = [];
        $container = [];
        $timesheets = $request->input('timesheet_id', []);
        $updates = [];

        foreach ($formattedData as $rowID => &$data) {
            $this->pushData($data, $request);

            if (strtotime($data['time_in']) > strtotime($data['time_out'])) {
                $errors[$rowID] = ['field' => 'time_out', 'message' => 'Time out can not be before time in.'];
                continue;
            }
            if (in_array($time_in = $data['date'] . 'time_in' . $data['time_in'], $container)) {
                $errors[$rowID] = ['field' => 'time_in', 'message' => 'Two same time in records in same day.'];
                continue;
            }
            if (in_array($time_out = $data['date'] . 'time_out' . $data['time_out'], $container)) {
                $errors[$rowID] = ['field' => 'time_out', 'message' => 'Two same time out records in same day.'];
                continue;
            }
            array_push($container, $time_in, $time_out);

            if (!isset($timesheets[$rowID]) && $this->checkTsExists($data)) {
                $errors[$rowID] = ['field' => 'date', 'message' => 'Timesheet already exists on this day.'];
            } elseif (isset($timesheets[$rowID]) && $this->checkTsExists($data, [$timesheets[$rowID]])) {
                $errors[$rowID] = ['field' => 'date', 'message' => 'Timesheet already exists on this day.'];
            } elseif (isset($timesheets[$rowID])) {
                $updates[$timesheets[$rowID]] = $data;
                unset($formattedData[$rowID]);
            }
        }

        DB::beginTransaction();
        try {
            $id = Schedule::query()
                ->where('date', $td = $request->input('cal_date'))
                ->whereNotIn('id', $request->input('timesheet_id', []))
                ->delete();

            if (empty($errors)) {
                Schedule::query()->insert($formattedData);
                foreach ($updates as $id => $data) {
                    Schedule::query()->where('id', $id)->update($data);
                }
            } else {
                return response($errors, 422);
            }
            DB::commit();
            // return response(['message' => 'Timesheet schedule created successfully.'], 200);
            $request->merge(['date' => $td]);
            return app(ScheduleShowController::class)->create($request);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage()], 422);
        }
    }

    private function pushData(&$data, Request $request)
    {
        $data['date'] = date_create($data['date'])->format('Y-m-d');
        $data['court_id'] = $request->input('court_id');
        $data['user_id'] = $request->user()->id;
        $data['created_at'] = $data['updated_at'] = now();
        $data['userc_id'] = $request->user()->id;
        $data['time_in'] = date('H:i:s', strtotime($data['time_in']));
        $data['time_out'] = date('H:i:s', strtotime($data['time_out']));
    }

    private function checkTsExists($data, $existingIds = null)
    {
        return Schedule::query()
            ->when($existingIds, function ($query, $existingIds) {
                $query->whereNotIn('id', $existingIds);
            })
            ->where([
                'date' => $data['date'],
                'court_id' => request()->input('court_id'),
            ])
            ->where(function (IlluminateBuilder $query) use ($data) {
                $time_in = $data['time_in'];
                $time_out = $data['time_out'];
                $query->whereBetween('time_in', [$time_in, $time_out]);
                $query->orWhereBetween('time_out', [$time_in, $time_out]);
                $query->orWhereBetween(DB::raw("'$time_in'"), [DB::raw('time_in'), DB::raw('time_out')]);
                $query->orWhereBetween(DB::raw("'$time_out'"), [DB::raw('time_in'), DB::raw('time_out')]);
            })
            ->count();
    }

    private function bulkDataFormatter(array $formData): array
    {
        $formatted = [];
        foreach ($formData as $key => $data) {
            foreach ($data as $index => $value) {
                $formatted[$index][$key] = $value;
            }
        }
        return $formatted;
    }
}
