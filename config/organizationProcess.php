<?php


return [
//    Step 1
    [
        'step'=>1,
        'step_name'=>'Application Received',
        'step_type'=>'web',
        'progress_name'=>'Application Received'
    ],
    [
        'step'=>1,
        'step_name'=>'Application Received',
        'progress_name'=>'Status Changed to Review'
    ],
    [
        'step'=>1,
        'step_name'=>'Application Received',
        'step_type'=>'mail',
        'progress_name'=>'Email Notice to OAW'
    ],
    [
        'step'=>1,
        'step_name'=>'Application Received',
        'progress_name'=>'Email Notification to Applicant'
    ],
    // step 2 Approval
    [
        'step'=>2,
        'step_name'=>'Approval',
        'progress_name'=>'Approval'
    ],
    [
        'step'=>2,
        'step_name'=> 'Approval',
        'step_type' => 'Approval',
        'progress_name'=>'Approval Letter Generated'
    ],
    [
        'step'=>2,
        'step_name'=>'Approval',
        'step_type' => 'Approval',
        'progress_name'=>'Approval Letter Email Notice to Applicant'
    ],
//    Step 3 Denial
    [
        'step'=>2,
        'step_name'=>'Approval',
        'step_type'=>'Denial',
        'progress_name'=>'Denial'
    ],
    [
        'step'=>2,
        'step_name'=>'Approval',
        'step_type'=>'Denial',
        'progress_name'=>'Denial Letter Generated'
    ],
    [
        'step'=>2,
        'step_name'=>'Approval',
        'step_type'=>'Denial',
        'progress_name'=>'Denial Letter Email Notification'
    ],
    [
        'step'=>2,
        'step_name'=>'Approval',
        'step_type'=>'Denial',
        'progress_name'=>'Denial Letter Mail Notification'
    ]
];