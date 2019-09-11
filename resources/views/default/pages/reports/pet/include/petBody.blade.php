<div class="m-content" id="petReportContent" data-range="{{$dateRange}}">
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Support Cases-->
            <div class="m-portlet  m-portlet--full-height with-border">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Total Procedure By Surgery Provider
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget16">
                        <div class="row no-pad">
                            <div class="col-sm-12">
                                <!-- Total report table-->
                                <table class="table table-bordered table-sm m-table reportTable">
                                    <tr>
                                        <th>Provider</th>
                                        <th>Cats</th>
                                        <th>Dogs</th>
                                        <th>Total</th>
                                    </tr>
                                    @foreach($totalProcedure as $tp)
                                        <tr>
                                            <td>{{ucfirst($tp->cname)}}</td>
                                            <td>{{$tp->cats}}</td>
                                            <td>{{$tp->dogs}}</td>
                                            <td>{{$tp->total}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <!-- Total report table end-->

                                <!-- Total report Chart Section-->
                                <canvas height="230" width="500" id="totalSurgery" style="width: 500px; height: 230px"></canvas>
                                <!-- Total report Chart Section end-->

                                <!-- Total report table by provider Type-->
                                <table class="table table-bordered reportTable table-sm m-table m-table--head-bg-brand m-t-15">
                                    <thead>
                                    <tr>
                                        <th style="width:90%">Provider Rate</th>
                                        <th style="width:5%">No of Surgeries</th>
                                        <th style="width:5%">Percentage</th>
                                    </tr>
                                    </thead>
                                    @foreach($totalSurgeryProfit as $tp)
                                        <tr>
                                            <td>{{ucfirst($tp->provider_rate)}}</td>
                                            <td>{{$tp->no_surgeries}}</td>
                                            <td>{{$tp->percentage}}%</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <!-- Total report table by provider Type end-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Stats-->
        </div>
        <div class="col-xl-6">
            <!--begin:: Widgets/Support Requests-->
            <div class="m-portlet  m-portlet--full-height with-border">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                IE Client Procedures By Surgery Provider
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget16">
                        <table class="table table-bordered table-sm m-table  reportTable">
                            <tr>
                                <th>Provider</th>
                                <th>Cats</th>
                                <th>Dogs</th>
                                <th>Total</th>
                            </tr>
                            @foreach($totalIE as $tp)
                                <tr>
                                    <td>{{ucfirst($tp->cname)}}</td>
                                    <td>{{$tp->cats}}</td>
                                    <td>{{$tp->dogs}}</td>
                                    <td>{{$tp->total}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <!-- Total report Chart Section-->
                        <canvas height="230" width="500" id="totalIE"></canvas>
                        <!-- Total report Chart Section end-->

                        <table class="table table-bordered reportTable table-sm m-table m-table--head-bg-brand m-t-15">
                            <thead>
                            <tr>
                                <th style="width:90%">Provider Rate</th>
                                <th style="width:5%">No of Surgeries</th>
                                <th style="width:5%">Percentage</th>
                            </tr>
                            </thead>
                            @foreach($totalIESurgeryBYProfit as $tp)
                                <tr>
                                    <td>{{ucfirst($tp->provider_rate)}}</td>
                                    <td>{{$tp->no_surgeries}}</td>
                                    <td>{{$tp->percentage}}%</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Requests-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Support Cases-->
            <div class="m-portlet  m-portlet--full-height with-border">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                NP Allocation Procedures By Surgery Provider
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget16">
                        <table class="table table-bordered table-sm m-table  reportTable">
                            <tr>
                                <th>Provider</th>
                                <th>Cats</th>
                                <th>Dogs</th>
                                <th>Total</th>
                            </tr>
                            @foreach($totalNP as $tp)
                                <tr>
                                    <td>{{ucfirst($tp->cname)}}</td>
                                    <td>{{$tp->cats}}</td>
                                    <td>{{$tp->dogs}}</td>
                                    <td>{{$tp->total}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <!-- Total report Chart Section-->
                        <canvas height="230" width="500" id="totalNP"></canvas>
                        <!-- Total report Chart Section end-->
                        <table class="table table-bordered reportTable table-sm m-table m-table--head-bg-brand m-t-15">
                            <thead>
                            <tr>
                                <th style="width:90%">Provider Rate</th>
                                <th style="width:5%">No of Surgeries</th>
                                <th style="width:5%">Percentage</th>
                            </tr>
                            </thead>
                            @foreach($totalNPSurgeryBYProfit as $tp)
                                <tr>
                                    <td>{{ucfirst($tp->provider_rate)}}</td>
                                    <td>{{$tp->no_surgeries}}</td>
                                    <td>{{$tp->percentage}}%</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Stats-->
        </div>
        {{--<div class="col-xl-6">--}}
            {{--<!--begin:: Widgets/Support Requests-->--}}
            {{--<div class="m-portlet  m-portlet--full-height with-border">--}}
                {{--<div class="m-portlet__head">--}}
                    {{--<div class="m-portlet__head-caption">--}}
                        {{--<div class="m-portlet__head-title">--}}
                            {{--<h3 class="m-portlet__head-text">--}}
                                {{--NP Allocation Utilization Report--}}
                            {{--</h3>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="m-portlet__body">--}}
                    {{--<div class="m-widget16">--}}
                        {{--<table class="table table-bordered table-sm m-table  reportTable">--}}
                            {{--<tr>--}}
                                {{--<th>Provider</th>--}}
                                {{--<th>Cats</th>--}}
                                {{--<th>Dogs</th>--}}
                                {{--<th>Total</th>--}}
                            {{--</tr>--}}
                            {{--@foreach($totalIE as $tp)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ucfirst($tp->cname)}}</td>--}}
                                    {{--<td>{{$tp->cats}}</td>--}}
                                    {{--<td>{{$tp->dogs}}</td>--}}
                                    {{--<td>{{$tp->total}}</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end:: Widgets/Support Requests-->--}}
        {{--</div>--}}
    </div>
</div>