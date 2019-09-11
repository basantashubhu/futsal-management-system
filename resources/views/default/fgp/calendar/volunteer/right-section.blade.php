<fieldset>

    <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding" style="border-top: 5px solid #008ab2; border-radius: 5px;">
            <div class="row m-row--no-padding m-row--col-separator-xl" style="padding-top: 10px;">
                <div class="col-md-4 col-lg-4 col-xl-4 pb-10">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">                                                
                            <div class="row ml-15 mr-15 align-center">
                                <div class="col-md-3 mt-5 no-padding">
                                    <img class="m--img-rounded grid-img" src="../../assets/app/media/img/users/avatar.jpg" title="" style="max-width: 75px; max-height: 75px;">
                                </div>
                                <div class="col-md-9 mt-15" style="padding-left: 0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td><h6>Name</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">
                                                                {{  $vol['middle_name'] ? join(' ', [$vol['first_name'], $vol['last_name']]) : join(" ".$vol['middle_name']." ", [$vol['first_name'], $vol['last_name']]) }}
                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Email</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">

                                                                {{ $vol['volunteer_contact']['email'] }}
                                                                
                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Contact</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">

                                                                {{ $vol['volunteer_contact']['cell_phone'] }}

                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 pb-10">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            {{-- <h4 class="m-widget24__title">
                                Supervisor
                            </h4><br> --}}
                            <div class="row ml-15 mr-15">
                                <div class="col-md-12 mt-15">
                                    <div class="row">
                                        <div class="col-md-12 no-padding">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td><h6>Supervisor Name</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">
                                                                Supervisor
                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td><h6>ETO Balance</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">
                                                                {{$vol->etoBalance($timesheet->pay_period->id)?:'00:00'}}                                                                
                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>                                
                                                <tr>
                                                    <td><h6>Total {{$systemVariables['hoursType'] ?? 'Hours'}}</h6></td>
                                                    <td>
                                                        <h6>
                                                            <span class="m-widget24__desc ts-value-color">
                                                                {{$vol->total_hrs($timesheet->pay_period->id)}}
                                                            </span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            {{-- <h4 class="m-widget24__title">
                                Period
                            </h4><br> --}}
                            <div class="col-md-12 mt-10 ml-10">
                                <table style="width: 100%;">
                                    <tr>
                                        <td><h6>Period Start</h6></td>
                                        <td>
                                            <h6>
                                                <span class="m-widget24__desc ts-value-color">
                                                    {{ !is_null($timesheet) ? date('m/d/y', strtotime(newDate($timesheet->pay_period->start_date))) : ''}}
                                                </span>
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Period End</h6></td>
                                        <td>
                                            <h6>
                                                <span class="m-widget24__desc ts-value-color">
                                                   {{ !is_null($timesheet) ? date('m/d/y', strtotime(newDate($timesheet->pay_period->end_date))) : ''}}
                                                </span>
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Period Number</h6></td>
                                        <td>
                                            <h6>
                                                <span class="m-widget24__desc ts-value-color">
                                                    #{{$timesheet ? $timesheet->pay_period->period_no : ''}}
                                                </span>
                                            </h6>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
               
            </div>
        </div>
    </div>

    <?php

        $week_day = date_create($timesheet->date)->format("w");

        switch ($week_day) {
            case 6:
                $w = "Sa";
                break;
            case 0:
                $w = "S";
                break;
            case 1:
                $w = "M";
                break;
            case 2:
                $w = "T";
                break;
            case 3:
                $w = "W";
                break;
            case 4:
                $w = "Th";
                break;
            case 5:
                $w = "F";
                break;
            
            default:
                # code...
                break;
        }

        $formatted_date = date('m/d/y', strtotime($timesheet->date));

    ?>  

    <div class="m-portlet">
        <div class="m-portlet__body pd-10-i">
            @if(can_access_ts($timesheet->id))
                <div class="ml-auto m-b-10" style="display: flex; justify-content: flex-end;">
                    <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill editable-vol-site-ts" style="margin-right: 7px"><i class="la la-refresh"></i>&nbsp;Edit</button>
                    <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill clear-vol-site-ts" style="margin-right: 7px"><i class="la la-refresh"></i>&nbsp;Clear</button>                
                    <button class="btn btn-success m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill save-vol-site-ts" 
                    data-timesheet-id="{{ $timesheet->id }}"
                    style="margin-right: 7px"><i class="la la-refresh"></i>&nbsp;Save TimeSheet</button>
                </div>
            @endif
                        
                <table class="table m-table m-table--head-bg-success templateTable cal-table-ts @if($timesheet) cal-ts-generated @endif" 
            style="border: 1px solid #e8e8e8; margin-bottom: 0px"
            >
                <thead>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Break In</th>
                    <th>Break Out</th>
                    {{-- <th>Items</th>
                    <th>Value</th>
                    <th>Amount</th> --}}
                    <th>Total {{$systemVariables['hoursType'] ?? 'Hours'}}</th>
                    <th></th>
                </thead>
                <tbody>
                    
                    <tr class="odd">
                        <td style="font-weight: 600; width: 100px">
                            {{$formatted_date}} ({{$w}})

                            <input type="hidden" name="template_id" value="{{$timesheet->id}}">
                        </td>
                        <td style="width: 150px;">
                            <select class="form-control m-input stipendType" name="time_type">
                                <option 
                                value="{{isset($timesheet['type_label']) ? $timesheet['type_label'] :''}}" 
                                selected>
                                    {{isset($timesheet['type_label']) ? $timesheet['type_label'] :''}}
                                </option>                                
                            </select>

                            <label>{{ $timesheet->type_label }}</label>
                        </td>
                        <td style="width: 100px">
                            <input type="text" class="form-control m-input timein_timepicker"
                            name="time_in"
                            value="{{isset($timesheet->time_in) ? date_create($timesheet->time_in)->format('G:i') : ''}}"
                            >

                            <label>
                                {{date_create($timesheet->time_in)->format('G:i')}}
                            </label>
                        </td>
                        <td style="width: 100px">
                            <input type="text" class="form-control m-input timeout_timepicker"
                            name="time_out"
                            value="{{isset($timesheet ->time_out) ? date_create($timesheet->time_out)->format('G:i') :''}}" 
                            >
                            
                            <label for="">
                                {{date_create($timesheet->time_out)->format('G:i')}}
                            </label>
                        </td>
                        <td style="width: 100px">
                            <input type="text" class="form-control m-input break_timepicker"
                            name="break_in"
                            value="{{isset($timesheet->break_in) ? date_create($timesheet->break_in)->format('G:i') :''}}" 
                            >

                            <label for="">
                                {{date_create($timesheet->break_in)->format('G:i')}}
                            </label>
                        </td>
                        <td style="width: 100px">
                            <input type="text" class="form-control m-input break_timepicker"
                            name="break_out"
                            value="{{isset($timesheet->break_out) ? date_create($timesheet->break_out)->format('G:i') :''}}" 
                            >

                            <label for="">
                                {{date_create($timesheet->break_out)->format('G:i')}}
                            </label>
                        </td>
                        {{-- <td></td>
                        <td></td>    
                        <td></td> --}}    
                        <td style="width: 100px">
                            <input type="text" class="form-control m-input" 
                            name="total_hr" 
                            value="{{isset($timesheet->total_hrs) ? date_create($timesheet->total_hrs)->format('G:i') :'0.0'}}"
                            >

                            <label>{{date_create($timesheet->total_hrs)->format('G:i')}}</label>
                        </td>
                        <td style="width: 40px"></td>
                    </tr>
                    <tr class="odd">
                        <td></td>
                        <td colspan="3">
                            <p class="itemLabel"><strong class="no-pd-i">Comment</strong></p>
                        </td>
                        <td>
                            <p class="itemLabel"><strong class="no-pd-i">Items</strong></p>
                        </td>
                        <td>
                            <p class="itemLabel"><strong class="no-pd-i">Category</strong></p>
                        </td>
                        <td>
                            <p class="itemLabel"><strong class="no-pd-i">Amount</strong></p>
                        </td>
                        <td></td>
                    </tr>
                    @if(count($timesheet->timesheetItems))                    

                       @foreach($timesheet->timesheetItems as $stipend_item)

                            <tr class="odd">
                                @if($loop->index === 0)
                                    <td>
                                        
                                    </td>
                                    <td colspan="3">                                               
                                        <textarea placeholder="comment" rows="1" class="form-control" name="comment">{{$timesheet->comment?: ''}}</textarea>
                                       
                                        <label>{{$timesheet->comment?:'---'}}</label>
                                    </td>
                                @else 
                                    <td colspan="4" class="no-br-top"></td>
                                @endif
                                
                                <td>
                                    <select name="label[]" id="" class="form-control stipendCategorySelect">
                                        <option value="{{$stipend_item->type}}">{{$stipend_item->type}}</option>
                                    </select>

                                    <label>{{$stipend_item->type}}</label>
                                </td>
                                <td>
                                    <select name="value[]" id="" class="form-control stipendCategoryValue">
                                        <option value="{{$stipend_item->value}}">{{$stipend_item->value}}</option>
                                    </select>

                                    <label for="">{{$stipend_item->value}}</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control m-input appendAmount" name="amount[]" placeholder="Amount" value="{{$stipend_item->amount?number_format($stipend_item->amount, 2,'.',''):''}}">
                                    <label>{{$stipend_item->amount?number_format($stipend_item->amount, 2,'.',''):''}}</label>
                                </td>
                                <td>
                                    @if($loop->index === 0)
                                        <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addCalTsOption" style="width:20px; height:20px;margin-top:5px;"                                        
                                        >
                                            <i class="la la-plus"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeCalTsOption" style="width:20px; height:20px;margin-top:5px;" >
                                            <i class="la la-remove"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>

                       @endforeach

                    @else                   

                        <tr class="odd">
                             
                            <td>
                                
                            </td>
                            <td colspan="3">                                               
                                <textarea placeholder="comment" rows="1" class="form-control" name="comment"></textarea>
                               
                            </td>
                             
                            <td>
                                <select name="label[]" id="" class="form-control stipendCategorySelect">
                                </select>

                            </td>
                            <td>
                                <select name="value[]" id="" class="form-control stipendCategoryValue">
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control m-input appendAmount" name="amount[]" placeholder="Amount">
                            </td>
                            <td>
                                 <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addCalTsOption" style="width:20px; height:20px;margin-top:5px;"                                        
                                 >
                                     <i class="la la-plus"></i>
                                 </a>
                                
                             </td>
                        </tr>

                    @endif

                </tbody>
            </table>
        </div>
    </div>
    

</fieldset>