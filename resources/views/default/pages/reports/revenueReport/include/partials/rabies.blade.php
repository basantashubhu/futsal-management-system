<!--begin:: Widgets/Support Cases-->
<div class="m-portlet  m-portlet--full-height with-border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Rabies Vaccinations given to Animals - per year
                </h3>
            </div>

        </div>
    </div>
    <div class="m-portlet__body">
        <div class="m-widget16">
            <div class="row">
                <div class="col-md-5">
                    <table class="table table-border">
                        <tr>
                            <th>&nbsp;</th>
                            <th style="color: rgb(54, 163, 247)">NP</th>
                            <th style="color: rgb(52, 191, 163);">IE</th>
                            <th>Total</th>
                        </tr>

                        @foreach($rabiesData as $data)
                            <tr>
                                <th>{{$data->date}}</th>
                                <td>{{$data->NP}}</td>
                                <td>{{$data->IE}}</td>
                                <td>{{$data->IE+$data->NP}}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <div class="col-md-7">
                    <canvas id="rabiesBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end:: Widgets/Support Stats-->