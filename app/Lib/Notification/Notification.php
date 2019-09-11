<?php


namespace App\Lib\Notification;

use App\Models\Invoice;
use App\Models\Note;
use App\Models\Notification as Notify;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class Notification
 * @package App\Lib\Notification
 */
class Notification implements ShouldQueue
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allNotification()
    {
        return Note::all();
    }

    /**
     * @return array
     */
    public function getNotification()
    {
        return array(
            'total' => count($this->unreadNotification()),
            'notification' => $this->unreadNotification(),
            'reminder' => $this->unreadReminders()
        );
    }

    /**
     * @return mixed
     */
    public function unreadNotification()
    {
        if(auth()->user()->role->id != 1){
            return Notify::where('to', auth()->id())->where('is_read', false)->get();
        }else{
            return Notify::where('is_read', false)->get();
        }
    }

    public function unreadReminders()
    {
        if(auth()->user()->role->id != 1){
            return Notify::where('to', auth()->id())->where('is_read', false)->get();
        }else{
            return Notify::where('is_read', false)->get();
        }
    }

    /**
     * @param $userid
     * @param $notification
     */
    public function notify($userid, $notification)
    {
        if ($this->checkUserNotification($notification['activity'], $userid)) {
            $note = new Note;
            $note->user_id = $userid;
            foreach ($notification as $key => $value)
                $note->$key = $value;
            $note->is_notification = true;
            $note->save();
        }
    }

    protected function checkUserNotification($code, $user)
    {
        $user = User::find($user);

        $settings = $user->settings;
        foreach ($settings as $setting) {
            if ($setting->code == $code) {
                if (!$settings->value)
                    return false;
                else
                    return true;
            }
        }
        return true;
    }


    /**
     * @param $client
     */
    public static function ClientCreationNotification($client, $activity = "Default")
    {
        $role = ['superAdmin', 'admin', 'supervisor'];
        $notification = array(
            'table_name' => 'Client',
            'table_id' => $client->id,
            'title' => ucfirst($client->fname . ' ' . $client->mname . ' ' . $client->lname) . ' has been Registered as Client',
            'note_type' => 'notification',
            'activity' => $activity,
            'url' => 'client'
        );
        $notify = new static();
        $recievers = $notify->getUserIds($role);
        foreach ($recievers as $reciever) {
            $notify->notify($reciever, $notification);
        }
    }


    /**
     * @param $application
     */
    public static function newApplicationCreation($application, $activity = "Default")
    {
        $role = ['superAdmin', 'admin', 'supervisor'];

        $client = $application->client;
        $notification = array(
            'table_name' => 'Application',
            'table_id' => $application->id,
            'title' => 'A New Application has been submitted by ' . ucfirst($client->title . ' ' . $client->fname . ' ' . $client->lname),
            'note_type' => 'notification',
            'activity' => $activity,
            'url' => 'application/' . $application->id
        );
        $notify = new static();
        $recievers = $notify->getUserIds($role);
        foreach ($recievers as $reciever) {
            $notify->notify($reciever, $notification);
        }
    }

    /**
     * @param $application
     */
    public static function applicationStatusChanged($application, $status = "Review")
    {

        $notification = array(
            'table_name' => 'Application',
            'table_id' => $application->id,
            'title' => 'Your Application\'s Status has been changed to ' . $status,
            'note_type' => 'notification',
            'activity' => 'Default',
            'url' => 'sp_applicationSingle/' . $application->id
        );
        $notify = new static();
        $notify->notify($application->client->user->id, $notification);
    }

    /**
     * @param $application
     */
    public static function invoiceStatusChanged($invoice, $application, $status = "Approved")
    {

        $notification = array(
            'table_name' => 'Invoice',
            'table_id' => $invoice->id,
            'title' => 'Your Invoice has been ' . $status,
            'note_type' => 'notification',
            'activity' => 'Default',
            'url' => 'sp_invoice'
        );
        $notify = new static();
       /* if ($application->provider) {
            $notify->notify($application->provider->contactPerson->user->id, $notification);
        }*/
    }


    /**
     * @param $application
     */
    public static function applicationReviewed($application, $activity = "Default")
    {

        $notification = array(
            'table_name' => 'Application',
            'table_id' => $application->id,
            'title' => 'Your application is currently being reviewed.',
            'note_type' => 'notification',
            'activity' => $activity,
            'url' => 'sp_applicationSingle/' . $application->id
        );
        $notify = new static();
        $notify->notify($application->client->user->id, $notification);
    }

    /**
     * @param $application
     */
    public static function applicationApproved($application, $activity = "Default")
    {

        $notification = array(
            'table_name' => 'Application',
            'table_id' => $application->id,
            'title' => 'Your Application has been approved',
            'note_type' => 'notification',
            'activity' => $activity,
            'url' => 'sp_applicationSingle/' . $application->id
        );
        $notify = new static();
        $notify->notify($application->client->user->id, $notification);

        if ($application->provider && $application->provider->contactPerson && $application->provider->contactPerson->user) {
            $notification1 = array(
                'table_name' => 'Application',
                'table_id' => $application->id,
                'title' => 'A new Application has been has been recieved. Check Service Queue',
                'note_type' => 'notification',
                'activity' => $activity,
                'url' => 'sp_serviceQueue'
            );
            $spnotify = new static();
            $spnotify->notify($application->provider->contactPerson->user->id, $notification1);
        }

    }

    public static function applicationDenied($application, $activity = "Default")
    {

        $notification = array(
            'table_name' => 'Application',
            'table_id' => $application->id,
            'title' => 'Your Application has been denied',
            'note_type' => 'notification',
            'activity' => $activity,
            'url' => 'sp_applicationSingle/' . $application->id
        );
        $notify = new static();
        $notify->notify($application->client->user->id, $notification);
    }

    public static function CreateReminder($event, $activity = "Default")
    {
        $notification = array(
            'table_name' => 'event',
            'table_id' => $event->id,
            'title' => $event->title,
            'activity' => $activity,
            'note_type' => $event->type,
            'url' => 'calendar'
        );
        $notify = new static();
        $notify->notify(1, $notification);
    }

    protected function getUserIds($roles)
    {
        $ids = array();
        foreach ($roles as $r) {
            $role = Role::where('name', $r)->first();
            $ids = array_merge($ids, $role->getUserbyRole());
        }
        return $ids;
    }

    public static function timesheetApprovalNotifications($approval, $stipend)
    {
        $notification = [];
        foreach (auth()->user()->reportingMgr as $mgr)
        $notification[] = array(
            'table_name' => $approval->getTable(),
            'table_id' => $approval->id,
            'user_id' => auth()->id(),
            'to' => $mgr->id,
            'message' => 'Period '.$stipend->period_no. ' from '.date('m/d/Y', strtotime($stipend->start_date)).' - '.date('m/d/Y', strtotime($stipend->end_date)).' of Timesheet has been approved by '. ucfirst(auth()->user()->member->first_name) .' '.ucfirst(auth()->user()->member->last_name) .' ('.ucfirst(auth()->user()->role->name).')',
            'type' => 'Notification',
            'url' => 'time-sheets'
        );
        $notify = new static();
        foreach ($notification as $message)
        $notify->makeNotification($message);
    }
    public static function timesheetApprovalNotificationsToAll($stipend, $user, $emails)
    {
        foreach($emails as $email){
            $u = User::where('email', $email)->first();
            if($u->id != $user->id){
                $notification = array(
                    'table_name' => $stipend->getTable(),
                    'table_id' => $stipend->id,
                    'user_id' => $user->id,
                    'to' => $u->id,
                    'message' => 'Period '.$stipend->period_no. ' from '.date('m/d/Y', strtotime($stipend->start_date)).' - '.date('m/d/Y', strtotime($stipend->end_date)).' of Timesheet has been approved by '. ucfirst($user->member->first_name) .' '.ucfirst($user->member->last_name) .' ('.ucfirst($user->role->name).')',
                    'type' => 'Notification',
                    'url' => 'time-sheets'
                );
                self::makeNotification($notification);
            }
        }
    }
    public static function timesheetDeclineNotifications($approval, $stipend, $user)
    {
        $notification = array(
            'table_name' => $approval->getTable(),
            'table_id' => $approval->id,
            'user_id' => auth()->id(),
            'to' => $user->id,
            'message' => 'Period '.$stipend->period_no. ' from '.date('m/d/Y', strtotime($stipend->start_date)).' - '.date('m/d/Y', strtotime($stipend->end_date)).' of Timesheet has been declined by '. ucfirst(auth()->user()->name) .' ('.ucfirst(auth()->user()->role->name).')',
            'type' => 'Notification',
            'url' => 'time-sheets'
        );
        $notify = new static();
        $recievers = $notify->makeNotification($notification);
    }

    public static function timesheetGenerated($volunteer)
    {
        if(isset($volunteer->supervisors)){
            foreach($volunteer->supervisors as $sup){
                $notification = array(
                    'table_name' => $volunteer->getTable(),
                    'table_id' => $volunteer->id,
                    'user_id' => auth()->id(),
                    'to' => $sup->id,
                    'message' => 'A New Timesheet has been generated.',
                    'type' => 'Notification',
                    'url' => 'time-sheets'
                );
                $notify = new static();
                $recievers = $notify->makeNotification($notification);
            }
        }else{
            $notification = array(
                'user_id' => auth()->id(),
                'to' => auth()->id(),
                'message' => 'A New Timesheet has been generated.',
                'type' => 'Notification',
                'url' => 'time-sheets'
            );
            $notify = new static();
            $recievers = $notify->makeNotification($notification);
        }
    }

    public static function makeNotification($notification)
    {
        $note = new Notify();
        foreach ($notification as $key => $value){
            $note->$key = $value;
        }
        $note->save();
    }

}