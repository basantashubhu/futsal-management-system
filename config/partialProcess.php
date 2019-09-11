<?php


return [
//    Step 1
    [
        'step' => 1,
        'step_name' => 'Application',
        'step_type' => 'web',
        'progress_name' => 'Application Received'
    ],
    [
        'step' => 1,
        'step_name' => 'Application',
        'step_type' => 'mail',
        'progress_name' => 'Application Received by Paper Mail'
    ],
    [
        'step' => 1,
        'step_name' => 'Application',
        'step_type' => 'mail',
        'progress_name' => 'Application Data Entry'
    ],
    [
        'step' => 1,
        'step_name' => 'Application',
        'progress_name' => 'Status Email Notification'
    ],
    // step 2 choose service Provider and treatment

//    Step 4 Denial
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Generated'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Email Notification'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Mail Notification'
    ],
//    Step 4 Approval
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approved'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approval Letter Generated'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Surgery Certificate Generated'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approval Letter Email Notice to Applicant & Attach Certificate'
    ],
    [
        'step' => 2,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approval Letter & Certificate Post Mail To Applicant'
    ],


        //step 6 Invoice & payment
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Approved',
        'progress_name' => 'Service Provider Invoice Received'
    ],
  /*  [
        'step' => 3,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Review Email Notification Sent'
    ],*/
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Approved',
        'progress_name' => 'Invoice Approved'
    ],
  /*  [
        'step' => 3,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Invoice Approval Email Notification'
    ],*/
   /* [
        'step' => 3,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Processed Email Notification'
    ],*/

    //step 6 invoice & payment Denial
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial'
    ],
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Generated'
    ],
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Email Notification'
    ],
    [
        'step' => 3,
        'step_name' => 'Invoice',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Mail Notification'
    ],
    [
        'step' => 4,
        'step_name' => 'Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Made'
    ],
    [
        'step' => 4,
        'step_name' => 'Payment',
        'step_type' => 'Denial',
        'progress_name' => 'Payment Denial Letter Mail Notification'
    ],

];