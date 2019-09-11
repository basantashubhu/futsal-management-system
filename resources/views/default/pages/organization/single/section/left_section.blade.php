<div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard"
                     style="width: 100%">
                    <!--begin: Message container -->
                    <div class="m-portlet__padding-x">
                        <!-- Here you can put a message or alert -->
                    </div>
                    <!--end: Message container -->
                    <!--begin: Form Wizard Head -->
                    <div class="m-wizard__head m-portlet__padding-x no-pd-i" style="margin: 2rem 0 0 0;">
                        <!--begin: Form Wizard Progress -->
                        <div class="m-wizard__progress" style="width: 82%;">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100" style="width: {{50*($step->step)}}%"></div>
                            </div>
                        </div>
                        <!--end: Form Wizard Progress -->
                        <!--begin: Form Wizard Nav -->
                        <div class="m-wizard__nav">
                            <div class="m-wizard__steps">
                                <?php $pStep = ['1' => 'Review', '2' => 'Approval', '3' => 'Close'] ?>
                                @foreach($pStep as $key=>$s)

                                    <div class="m-wizard__step
                            @if($key<=$step->step)
                                            m-wizard__step--done
@elseif($key==$step->step+1)
                                            m-wizard__step--next
@endif
                                            " data-wizard-target="#m_wizard_form_step_{{$key}}">
                                        <a href="#" class="m-wizard__step-number">
                                <span style="width: 2rem; height: 2rem; margin: -4.05rem auto 0 auto; color: #fff;">
                                    {{$key}}
                                </span>
                                        </a>
                                        <div class="m-wizard__step-info">
                                            <div class="m-wizard__step-title"
                                                 style="font-size: 1rem; margin: -0.2rem 0 0.7rem 0;">
                                                {{$s}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--             <div class="m-portlet__head-tools">
                            <div class="row">
                                <div class="col">
                                    <div class="applicationQuickActions">
                                        <div class="btn-group mr-2 no-m-i" role="group" aria-label="...">
                                            <button type="button"
                                                    class="btn btn-outline-metal btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill no-m-i"
                                                    title="Prints">
                                                <i class="la la-print"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
        </div>
        <div class="m-portlet__body" id="OrgSinglePrint">
            <div class="row no-m pd-b-20">

                <div class="col-sm-12 col-md-12 no-pd-i">
                    <div class="app-col-seperator m-b-30 height-100">
                        <div class="app-col-header">
                            <div class="app-col-header-caption">
                                <span class="custom-header std-header">Organization Details</span>
                            </div>
                            <div class="app-col-header-tool">
                                <button class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                                        data-modal-route="organization/edit/{{$organization->id}}"><i class="la la-edit"></i>
                                </button>
                                <button class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                                        data-print='/print/organization/{{$organization->id}}'
                                ><i class="la la-print"></i>
                                </button>
                            </div>
                        </div>

                        <div class="app-col-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="no-list-style no-m">
                                        <li><strong>Organization Name</strong></li>
                                        <li>{{$organization->cname}}</li>
                                        <li>&nbsp;</li>
                                        <li><strong>License Number</strong></li>
                                        <li>{{$organization->lic_no}}</li>
                                        <li><strong>Invoice Code</strong></li>
                                        <li>{{is_null($organization->invoice_code)?"DE":$organization->invoice_code}}</li>
                                        <li> <strong>Activation</strong></li>
                                        <li>
                                            @if($organization->is_active)
                                            <span class="m-badge m-badge--success m-badge--wide c-p" data-modal-route="org_active/page/{{$organization->id}}">
                                                Active
                                            </span>
                                            @else
                                            <span class="m-badge m-badge--danger m-badge--wide c-p" data-modal-route="org_active/page/{{$organization->id}}">
                                                Deactive
                                            </span>
                                            @endif
                                        </li>
                                    </ul>
                                    <br>

                                    @include('default.pages.organization.single.section.representative')

                                </div>
                                <div class="col-sm-4">
                                    <label class="f-w-500 header">Contact Details</label>
                                    <ul class="no-list-style no-m">
                                        @if(isset($organization->contact->phone))
                                        <li><i class="la la-phone"></i> &nbsp;{{$organization->contact->phone}}</li>
                                        @endif
                                        @if(isset($organization->contact->company_email))
                                        <li class="t-c-b"><i class="la la-envelope-o"></i>
                                            &nbsp;<span class="emailSend t-u-b c-p" data-value="{{$organization->contact->company_email}}">{{$organization->contact->company_email}}</span></li>
                                        @else
                                        <li class="t-c-b"><i class="la la-envelope-o"></i>
                                            <span class="emailSend t-u-b c-p" data-value="{{$organization->contact->company_email}}">No Email</span></li>
                                        @endif
                                    </ul>
                                    <ul class="no-list-style no-m">
                                        <li><i class="la la-map-marker"></i>
                                            &nbsp;{{$organization->address->add1}} @if(isset($organization->address->add2))
                                                , {{$organization->address->add2}} @endif</li>
                                        @if($organization->address && $organization->address->zip)
                                            <li><i class="la la-map-o"></i> &nbsp;
                                                {{!is_null($organization->address->city)?$organization->address->city:$organization->address->zip->city}}

                                                @if($organization->address->state)
                                                    , {{ucfirst($organization->address->state)}}
                                                @elseif($organization->address->zip->state)
                                                    , {{ucfirst($organization->address->zip->state)}}
                                                @endif

                                                @if($organization->address->zip_code)
                                                    {{ucfirst($organization->address->zip_code)}}
                                                @elseif($organization->address->zip->zip_code)
                                                    {{ucfirst($organization->address->zip->zip_code)}}
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <label class="f-w-500 header">Status</label>
                                    <ul class="no-list-style no-m">
                                        @if($organization->is_approved==1)
                                            <li>Approved
                                                Date: {{date('m/d/Y', strtotime($organization->approval_date))}}</li>
                                            <li>Status:
                                                <span class="m-badge m-badge--approved m-badge--wide c-p">
                                                    Approved
                                                </span>
                                            </li>
                                        @elseif($organization->is_approved==2)
                                            <li>Created
                                                Date: {{date('m/d/Y', strtotime($organization->created_at))}}</li>
                                            <li>Status:
                                                <span class="m-badge m-badge--accent m-badge--wide c-p">
                                                    Review
                                                </span>
                                            </li>
                                        @elseif($organization->is_approved==3)
                                            <li>Created
                                                Date: {{date('m/d/Y', strtotime($organization->created_at))}}</li>
                                            <li>Status:
                                                <span class="m-badge m-badge--danger m-badge--wide c-p"
                                                     data-modal-route="denailReason/{{$organization->id}}">
                                                    Denial
                                                </span>
                                            </li>

                                        @else
                                            <li>Created
                                                Date: {{date('m/d/Y', strtotime($organization->created_at))}}</li>
                                            <li>Status:
                                                <div class="m-badge m-badge--brand m-badge--wide c-p">Pending</div>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Files -->
        @include('default.pages.organization.single.section.files')
        <!-- Files End -->

            <!-- Signeture -->
            <div class="row">
                <div class="col">
                    <div class="top-border-seperetor">
                        <div class="m-t-20">
                            <div class="row justify-content-between">
                                <!-- <div class="col-4">
                                    Signeture Section
                                </div> -->
                                <div class="col-12">
                                    <div class="d-b">
                                        @if($organization->is_approved!=1 && $organization->is_approved!=3)
                                            <button class="btn btn-sm btn-danger m-btn m-btn--icon m-btn--pill float-left"
                                                    data-modal-route="org_disApproval/{{$organization->id}}"
                                                    id="disApprovedBtn">
											<span>
												<i class="fa fa-thumbs-o-down"></i>
												<span>
													Disapprove
												</span>
											</span>
                                            </button>
                                            <button class="btn btn-sm btn-success m-btn m-btn--icon m-btn--pill float-right"
                                                    data-modal-route="org_approval/{{$organization->id}}"
                                                    id="approvedBtn">
											<span>
												<i class="fa fa-thumbs-o-up"></i>
												<span>
													Approve
												</span>
											</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Signeture End -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).off('click', '.emailSend').on('click', '.emailSend', function (e) {
            e.preventDefault();
            var to = $(this).attr('data-value');
            showModal('email/send/'+to+'/{{$organization->id}}?table=organization');
        });
    })
</script>