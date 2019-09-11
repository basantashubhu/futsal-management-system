<?php

namespace App\Http\Controllers\Notification;

use App\Lib\Notification\Notification;
use App\Models\Notification as Notify;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

/**
 * Class NotificationController
 * @package App\Http\Controllers\Notification
 */
class NotificationController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $notification = new Notification;
        return $notification->getNotification();
    }

    public function getAll(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('notifications')
            ->select('notifications.*', DB::raw('concat(m.first_name, " ", m.last_name) as user_name'))
            ->join('members as m', 'm.user_id', 'notifications.user_id')
            ->where('notifications.is_read', 0);
        if (auth()->id() != 1) {
            $result = $result->where('notifications.to', auth()->id());
        }

        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy('notifications.created_at', 'desc');
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        // $totalResult = count($result->get());

        $result = $result->get();

        $data = [
            'meta' => [
                'page' => (int) $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int) $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }

    public function markAsRead(Notify $notification)
    {
        $notification->is_read = true;
        $notification->read_at = date('Y-m-d');
        $notification->save();
    }

    public function preview(Notify $notification)
    {
        return view('default.pages.note.modal.preview', compact('notification'));
    }

    public function bulkRead($table_id)
    {
        Notify::where([
            'table_name' => 'pay_periods',
            'to' => auth()->id(),
            'table_id' => $table_id
        ])
            ->update([
                'is_read' => true,
                'read_at' => date('Y-m-d')
            ]);
    }

    public function markAllAsRead()
    {
        Notify::where([
            'to' => auth()->id(),
            'is_read' => false
        ])
            ->update([
                'is_read' => true,
                'read_at' => date('Y-m-d')
            ]);
    }
}
