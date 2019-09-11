<?php


namespace App\Lib\Email;


use App\Mail\ApplicationApproved;
use App\Mail\ApplicationChangedToReview;
use App\Mail\ApplicationDenial;
use App\Mail\CopayReceived;
use App\Mail\CopayReminderNotice;
use App\Mail\InvoiceApproved;
use App\Mail\InvoiceDenial;
use App\Mail\InvoiceStatusChangeToReview;
use App\Mail\OrganizationDisapproved;
use App\Mail\OrganizationRequestApproved;
use App\Mail\OrgStatusReview;
use App\Mail\PaymentDepositedIntoBank;
use App\Mail\PaymentProcessStart;
use App\Mail\SurgeryCertificateIssue;
use App\Mail\UserCreated;
use App\Mail\SendVetEmail;

class EmailFactory
{

    public static function getMailer($mailerName, $data, $attachment = '')
    {
        switch ($mailerName) {
            case 'appApproved':
                return new ApplicationApproved($data, $attachment);
            case 'appChangeToReview':
                return new ApplicationChangedToReview($data);
            case 'spSurgeryCert':
                return new SurgeryCertificateIssue($data, $attachment);
            case 'appDenial':
                return new ApplicationDenial($data, $attachment);
            case 'invChangeToReview':
                return new InvoiceStatusChangeToReview($data);
            case 'invChangeToApprove':
                return new InvoiceApproved($data);
            case 'copayReceived':
                return new CopayReceived($data);
            case 'copayReminder':
                return new CopayReminderNotice($data);
            case 'invDenial':
                return new InvoiceDenial($data);
            case 'paymentProcess':
                return new PaymentProcessStart($data);
            case 'paymentDeposited':
                return new PaymentDepositedIntoBank($data);
            case 'orgStatusReview':
                return new OrgStatusReview($data);
            case 'orgApproved':
                return new OrganizationRequestApproved($data);
            case 'orgDisApproved':
                return new OrganizationDisapproved($data);
            case 'userCreated':
                return new UserCreated($data);
            case 'sendVetEmail':
                return new SendVetEmail($data);
        }
    }

}