<?php


namespace App\Repo;

use App\Lib\Filter\NoteFilter\NoteFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteRepo extends BaseRepo
{

    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $query = DB::table('notes')
            ->leftjoin('members as m', 'notes.userc_id', 'm.user_id')
            ->where('notes.is_deleted', 0)
            ->select(['notes.*']);

        $filter = new NoteFilter($request);
        $quick_filters = isset($_COOKIE['notes_quick']) ? json_decode($_COOKIE['notes_quick']) : [];
        $adv_filters = isset($_COOKIE['notes_advanced']) ? json_decode($_COOKIE['notes_advanced']) : [];
        $filter->getQueryCookie($query, $quick_filters + $adv_filters);

        $query->whereIn('note_type', ['todo', 'task', 'reminder']);

        $totalResult = count($query->groupBy('notes.id')->get());

        if (isset($request->sort['field'])) {
            $query = $query->orderBy($request->sort['field'], $request->sort['sort']);
        }

        if (!is_null($perpage)) {
            $query = $query->limit($perpage)->offset($offset);
        }

        $result = $query->groupBy('notes.id')->get();

        $data = [
            'meta' => [
                'page' => (int) $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int) $perpage,
                'total' => (int) $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field'],
            ],
            'data' => $result,
        ];
        return $data;
    }

    public function getAllForDashboard(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        // $query = DB::table('notes')
        //     ->join('volunteers', 'volunteers.id', 'notes.vol_id')
        //     ->join('sites', 'sites.id', 'notes.site_id')
        //     ->where('notes.is_notification', 0)
        //     ->where('notes.is_deleted', 0)
        //     ->select('volunteers.first_name', 'volunteers.last_name', 'sites.*', 'notes.*');

        $query = DB::table('notes')
            ->where('userc_id', auth()->id())
            ->where('is_completed', 0)
            ->select('notes.*');

        $filter = new NoteFilter($request);
        $filter->getQuery($query);
        $totalResult = count($query->get());

        if (isset($request->sort['field'])) {
            $query = $query->orderBy($request->sort['field'], $request->sort['sort']);
        }

        if (!is_null($perpage)) {
            $query = $query->limit($perpage)->offset($offset);
        }

        $result = $query->get();

        $data = [
            'meta' => [
                'page' => (int) $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int) $perpage,
                'total' => (int) $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field'],
            ],
            'data' => $result,
        ];
        return $data;
    }
}
