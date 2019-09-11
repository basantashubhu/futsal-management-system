<?php

namespace App\Traits;

use App\Models\User;

/**
 * Helper for getting email address of user according to hierarchy
 * 
 * In Process
 */
trait BulkMail
{
    private $hieararchy = ['fiscal', 'director', 'manager', 'supervisor'];

    public function getEmails(User $user, $direction = 1)
    {
        $emails = [];
        $haystack = $direction < 0 ? array_reverse($this->hieararchy) : $this->hieararchy;
        $position = array_search(strtolower($user->role->name), $haystack);
        $roles = array_slice($haystack, $position);
        foreach ($roles as $role) { }
    }

    protected function sendMailToAll(User $user)
    {
        try {
            $emails = [];
            if ($user->role->name == "supervisor") {

                // supervisor // manager // director // fiscal
                $emails = $user->reportingMgr()->with(['reportingMgr' => function ($dir) {
                    $dir->with('reportingMgr');
                }])->get()->map(function ($manager) {
                    // fiscals + director + manager
                    return $manager->reportingMgr->map(function ($director) {
                        //fiscals + director
                        return $director->reportingMgr->pluck('email')->merge($director->email);
                    })->collapse()->merge($manager->email);
                })->collapse()->merge($user->email)->unique()->all();
            } elseif ($user->role->name == "manager") {
                // manager // fiscal // director
                $emails = $user->reportingMgr()->with('reportingMgr')->get()->map(function ($director) {
                    // fiscals + director
                    return $director->reportingMgr->pluck('email')->merge($director->email);
                })->collapse()->merge($user->email);

                $sup_emails = $user->reportingMgrOf->pluck('email');
                $emails = $emails->merge($sup_emails)->unique()->all();
            } elseif ($user->role->name == "director") {
                // director // fiscal
                $emails = $user->reportingMgr->pluck('email')->merge($user->email)->unique();

                $managers = $user->reportingMgrOf()->with('reportingMgrOf')->get()->map(function ($manager) {
                    // supervisors + manager
                    return $manager->reportingMgrOf->pluck('email')->merge($manager->email);
                })->collapse();

                $emails = $emails->merge($managers)->unique()->all();
            } elseif ($user->role->name == "fiscal") {
                //fiscal // director // manager // supervisor
                $emails = $user->reportingMgrOf()->with(['reportingMgrOf' => function ($mgr) {
                    $mgr->with('reportingMgrOf');
                }])->get()->map(function ($director) {
                    // supervisor + manager + director
                    return $director->reportingMgrOf->map(function ($manager) {
                        // supervisor + manager
                        return $manager->reportingMgrOf->pluck('email')->merge($manager->email);
                    })->collapse()->merge($director->email);
                })->collapse()->unique()->all();
            }
            return $emails;
        } catch (\Exception $e) {
            throw $e;
            //            return $this->response($e->getMessage(), 'view', 422);
        }
    }
}
