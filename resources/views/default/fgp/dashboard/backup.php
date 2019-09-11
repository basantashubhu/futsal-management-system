    <div class="m-portlet">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body no-padding" id="tabelTimeSheet" style="display: none;">
                <!--begin: Search Form -->
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="d_template_datatable">
                    <table id="time_sheet_data_table" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th data-width="30px">
                                #
                            </th>
                            <th data-width="80px">Volunteer ID</th>
                            <th>Volunteer Name</th>
                            <th>Supervisor Name</th>
                            <th>County</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stipend_periods as $period)
                        @continue($loop->iteration >2)
                            <tr class="group">
                                <td data-field="stipend_period" colspan="7">
                                    <input type="checkbox" name="group_stipend" class="group_stipend_period" data-class="stipend_p{{ $period->id }}" data-id = {{$period->id}}>
                                    &nbsp; Period {{ $period->period_no }}
                                    &nbsp; &nbsp;
                                    {{ newDate($period->start_date) }} - {{ newDate($period->end_date) }}
                                </td>
                            </tr>
                            @foreach($period->collection as $timesheet)
                                <tr>
                                    <td data-width="30px" data-field="stipend_hash">
                                        <input type="checkbox" name="selected_timesheets[]"
                                               value="{{ $timesheet->id }}" class="selected_timesheets stipend_p{{ $period->id }}">
                                    </td>
                                    <td data-width="80px" data-field="vol_alt_id">{{ $timesheet->vol_alt_id }}</td>
                                    <td data-field="vol_name">{{ $timesheet->vol_name }}</td>
                                    <td data-field="vol_sup_name">{{ $timesheet->vol_sup_name }}</td>
                                    <td data-field="site_county">{{ $timesheet->site_county }}</td>
                                    <td data-field="comment">{{ isset($timesheet->comment)?$timesheet->comment:'' }}</td>
                                    <td>
                                        <div>
                                            <button class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit_timesheet" data-url="/timesheet/edit/{{$timesheet->id}}">
                                                <i class="la la-edit"></i>
                                            </button>
                                            <button class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill view_timesheet" data-url="/timesheet/edit/{{$timesheet->id}}">
                                                <i class="la la-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable -->
            </div>
            <div id="dynamicTimeSheet">
            </div>
            {{-- @include('default.fgp.timesheet.includes.addTimesheet') --}}
            {{-- @include('default.fgp.timesheet.includes.loadTimesheet') --}}
        </div>
    </div>


        <div class="panel-body" id="PeriodContents">
            {{-- contents --}}
        </div>
    </div>