<div class="m-content" id="treatmentReportContent" data-range="{{$dateRange}}">
    <div class="row no-pd">
        <div class="col-12 col-sm-12 col-md-6">
            <div class="m-portlet  m-portlet--full-height with-border">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Surgery Report by Provider
                                <small>(NP Allocation And IE Clients)</small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <table class="table table-bordered table-sm m-table reportTable">
                        <thead>
                        <tr>
                            <th rowspan="2">Provider</th>
                            <th colspan="2">Dog</th>
                            <th colspan="2">Cat</th>
                            <th colspan="2">Total</th>
                        </tr>
                        <tr>
                            <th>Applied</th>
                            <th>Performed</th>
                            <th>Applied</th>
                            <th>Performed</th>
                            <th>Applied</th>
                            <th>Performed</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($totalSurgery as $ts)
                            <tr>
                                <td>{{$ts->cname}}</td>
                                <td>{{$ts->dog_applied}}</td>
                                <td>{{$ts->dog_performed}}</td>
                                <td>{{$ts->cat_applied}}</td>
                                <td>{{$ts->cat_performed}}</td>
                                <td>{{$ts->total_applied}}</td>
                                <td>{{$ts->total_performed}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <canvas id="surgeryTotal"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6">
            <div class="m-portlet  m-portlet--full-height with-border">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Rabies Vaccinations by Provider
                                <small>(NP Allocation And IE Clients)</small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <table class="table table-bordered table-sm m-table reportTable">
                        <thead>
                        <tr>
                            <th rowspan="2">Provider</th>
                            <th colspan="2">Dog</th>
                            <th colspan="2">Cat</th>
                            <th colspan="2">Total</th>
                        </tr>
                        <tr>
                            <th>Applied</th>
                            <th>Performed</th>
                            <th>Applied</th>
                            <th>Performed</th>
                            <th>Applied</th>
                            <th>Performed</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($totalRabies as $ts)
                            <tr>
                                <td>{{$ts->cname}}</td>
                                <td>{{$ts->dog_applied}}</td>
                                <td>{{$ts->dog_performed}}</td>
                                <td>{{$ts->cat_applied}}</td>
                                <td>{{$ts->cat_performed}}</td>
                                <td>{{$ts->total_applied}}</td>
                                <td>{{$ts->total_performed}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <canvas id="rabiesTotal"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>