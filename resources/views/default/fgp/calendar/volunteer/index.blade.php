<form class="m-form" id="TimeSheetCreateForm" action="javascript:void(0)" >
    <div class="m-portlet site_add_form" style="background: #f2f3f8 !important;">
        <div class="m-portlet__body pd-t-10-i">     
            {{-- <div class="action-btn-ts">
                <button class="btn btn-success">Generate</button>
            </div> --}}

            <div class="row p-0">                    
                <div class="col-sm-12 col-md-3 col-lg-3 no-left-pad">
                    <div class="timesheet-left-list {{-- mb-15 --}}" style="border-top: 5px solid #008ab2; border-radius: 5px;">
                        <fieldset class="site_asic_info" 
                        style="padding-left: 0; padding-right: 0; padding-top: 5px; border: #e8e8e8; padding-bottom: 0;
                        background: #fff">
                            <div class="vol-ts-details">
                                
                            </div> 
                        </fieldset>                            
                    </div>

                    <div class="timesheet-left-list mb-10" style="border-radius: 5px;">
                        <fieldset class="site_asic_info" style="background: #fff; padding: 15px">
                            <div class="vol-ts-details">
                                    <h4>{{ ucfirst($site->site_name)}}</h4>
                                    @if($site->address)                                    

                                        <div class="site-addr ts-value-color">
                                            {{$site->address->add1}}<br>
                                            {{$site->address->region?:''}}
                                            {{$site->address->county?$site->address->county.' - ':''}}{{$site->address->district?$site->address->district.' - ':''}}{{$site->address->city}}
                                        </div>

                                    @endif
                                  
                                </div>
                                 
                        </fieldset>                            
                    </div>    

                    <div class="m-portlet pd-10">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--2x m-tabs-line--danger no-m-bottom" role="tablist">     

                          <li class="nav-item m-tabs__item no-m-right no-pd-bottom" 
                          >
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#calendar-vol-approvals" role="tab" style="height: 100%;">
                              Approvals
                            </a>
                          </li>     

                        </ul>

                        <div class="tab-content ts-panel-tab-content" id="calendar-vol-approvals">
                            <div class="tab-pane active">                                

                                <div class="cus-timeline vol-vertical-timeline">
                                    <ul>
                                        @foreach($apprvs as $key => $apprv)
                                            <li @if($apprv->user) class="timeline-complt" @endif>
                                                <div class="content">
                                                    <h3>{{ucfirst($apprv->role)}}</h3>
                                                    @if($apprv->user)
                                                        <div style="margin-top: 10px">
                                                            <p class="complt" style="text-transform: capitalize;">Approved By: {{$apprv->user->approver->fullName()}}</p>
                                                            <p class="complt">Approval Date : {{date_create($apprv->user->created_at)->format('m/d/y')}}</p>
                                                            <p class="complt">Sent notification to {{$apprv->user->next_approval}}</p>
                                                        </div>
                                                    @else
                                                        <div style="margin-top: 10px">
                                                            <p>Approved By: - - -</p>
                                                            <p>Sent notification to - - -</p>
                                                        </div>
                                                    @endif
                                                </div>                                                
                                            </li>
                                        @endforeach
                                        <div style="clear: both"></div>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>               

                </div>

                {{--   TIME SHEET  --}}

                <div class="col-sm-12 col-md-9 col-lg-9" id="calendar-vol-right-sec">
                    
                     @include('default.fgp.calendar.volunteer.right-section')

                </div>                             
                  
            </div>
        </div>
    </div>
    <!--end::Form-->
</form>

@include('default.fgp.calendar.volunteer._js')  
    

<style>
     body .bootstrap-select.btn-group > .btn-redius {
        background-color: #fff;
        border: 1px solid #d0d0d0;
        border-top-right-radius: 0.25rem!important;
        border-bottom-right-radius: 0.25rem !important;
    }

    /* width */
    ::-webkit-scrollbar {
      width: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }
    .width-20{
        width: 11% ;
    }

    #comment {
        min-height: 20px;
    }

    .fixer{
        position: fixed;
        top: 10%;
        width: 13%;
    }

    .action-btn-ts{
        display: flex;
        flex: 1;
        justify-content: flex-end;
    }


    .ts-detail-header{
        justify-content: space-between;
        padding: 0px 20px 20px 20px;
    }

    .ts-detail-header h4,
    .vol-list-header{
        color: #008ab2;
    }

    .ts-detail-header h5{
        font-size: 1rem;
        display: flex;
        justify-content: space-between;
    }

    .ts-detail-header h5 span{
        font-weight: 600;
    }

    .vlt-ts-i{

    }

    .first-flex{
        display: flex;
        flex: 0.5;
        justify-content: space-between;
    }

    .grid-2-2{
        display: grid;
        grid-template-columns: 30px 30px 0.6fr 1fr;
        grid-column-gap: 15px;
    }

    .grid-2{
        display: grid;
        grid-template-columns: 0.6fr 1fr;
        grid-column-gap: 15px;

    }

    .grid-img{
        grid-column: 1/3;
        grid-row: 1/4;
        height: 100%;
        width: 100%;
    }

    .vlt-ts-site-i{
        border-left: 1.5px solid #e8e8e8;
        padding-left: 25px;
    }


    .vol-ts-details ul{
        list-style: none;
        padding: 0;
        margin-bottom: 0;
    }

    .vol-ts-details ul li{
        padding: 10px;
        /*border-top: 1px solid #e8e8e8;*/
        border-bottom: 1px solid #e8e8e8;
        background: white;
    }

    .vol-ts-details ul li:hover{
        background-color: #f9f9f9;
        transition: all 300ms ease-in-out;
        cursor: pointer;
    }

    .vol-ts-active{
        background: #dc3545 !important;
        color: white;
        transition: all 600ms ease-in-out;
    }

    .vol-ts-active:hover{
        background: #dc3545;

    }
    
    .vol-ts-active label{
        color: white;
    }
   
   .vol-ts-active label span{
        border-color: white !important;
   }

   .vol-ts-active .m-checkbox > input:checked ~ span{
        border: 1px solid #fff !important;
   }

   .vol-ts-active .m-checkbox > span:after{
    border-color: white !important;
   }

   .search-ts-vol,
   .search-ts-site{
        display: flex;
        padding-left: 10px;
        padding-top: 10px;
        padding-right: 10px;
        justify-content: space-between;
        padding-bottom: 10px;
        align-items: center;
        /*background: #e2e2e2;*/
   }

   .search-ts-vol input:last-child,
   .search-ts-site input:last-child{
        margin-right: 10px;
   }

   .search-ts-vol label span,
   .search-ts-site label span{
        top: -5px;
   }

   .site_vol_selector li ul{
        margin-top: 10px;
   }

   .site_vol_selector li ul li:last-child{
        border-bottom: 0px;
   }

   .site-vol-list-li ul li{
        background: none;
   }

    .site-show-active div:first-child{
        background: #e8e8e8;
        padding: 10px 10px;
        transition: background 300ms ease-in-out;
    }

    .vol-level{
        display: flex;
        flex:1;
    }

    /*  new to this page  */

    .cal-table-ts td:not(.no-br-top){
        border-bottom: 1px solid #e8e8e8;
        border-left: 1px solid #e8e8e8;
        
    }

    .cal-table-ts td:last-child{
        border-left: none;
    }

    .odd{
        background-color: #f9f9f9;
    }

    .itemLabel{
        margin-bottom: 0;
    }

    .itemLabel strong{
        font-weight: 500;
        padding-left: 10px;
    }

    .cal-ts-generated input,
    .cal-ts-generated textarea,
    .cal-ts-generated .select2-container ,
    .cal-ts-generated a{
        display: none !important;
    }

    .cal-table-ts label{
        display: none;
    }

    .cal-ts-generated label{
        display: block;
    }

    .save-vol-site-ts,
    .clear-vol-site-ts{
        display: none;
    }


</style>