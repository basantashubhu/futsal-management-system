<?php


return [
//    Step 1
    [
        'step' => 1,
        'step_name' => 'Application',
        'step_type' => 'web',
        'progress_name' => 'Application Received by Web'
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
        'progress_name' => 'Status Changed to Review'
    ],
    [
        'step' => 1,
        'step_name' => 'Application',
        'progress_name' => 'Status Email Notification'
    ],
    // step 2 choose service Provider and treatment
    [
        'step' => 2,
        'step_name' => 'Assign Service Provider',
        'progress_name' => 'Choose Service Provider'
    ],
    [
        'step' => 2,
        'step_name' => 'Assign Service Provider',
        'progress_name' => 'Choose Veterinarian'
    ],

    [
        'step' => 3,
        'step_name' => 'Assign Procedure Plan',
        'progress_name' => 'Choose Procedure Plan'
    ],
//    Step 4 Denial
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Generated'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Email Notification'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Denial',
        'progress_name' => 'Denial Letter Mail Notification'
    ],
//    Step 4 Approval
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approved'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approval Letter Generated'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Surgery Certificate Generated'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Copay Reminder Letter'
    ],
    [
        'step' => 4,
        'step_name' => 'Approval',
        'step_type' => 'Approved',
        'progress_name' => 'Approval Letter Email Notice to Applicant & Attach Certificate'
    ],
//    Step 5 Applicant payment
    [
        'step' => 5,
        'step_name' => 'Copay',
        'progress_name' => 'Copay Received',
    ],
    [
        'step' => 5,
        'step_name' => 'Copay',
        'progress_name' => 'Copay Received Email Notification',
    ],
    [
        'step' => 5,
        'step_name' => 'Copay',
        'progress_name' => 'Copay Deposited to Bank'
    ],
    //step 6 Invoice & payment
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Service Provider Invoice Received'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Change Status to Review'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Review Email Notification Sent'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Invoice Approved'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Invoice Approval Email Notification'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Processed Email Notification'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Deposited to Bank Account'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Deposited Email Notification'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Payment Cheque Sent by Mail'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Approved',
        'progress_name' => 'Cheque Shipped And Sent Email Notification Along with Tracking Numbers'
    ],

    //step 6 invoice & payment Denial
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Generated'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Email Notification'
    ],
    [
        'step' => 6,
        'step_name' => 'Invoice & Payment',
        'step_type' => 'Denial',
        'progress_name' => 'Invoice Denial Letter Mail Notification'
    ],


];