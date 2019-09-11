<div class="modal-dialog modal-custom-medium-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Application Information
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <table class="table table-bordered m-table m-table--head-bg-success">
                <thead>
                    <tr>
                        <th>App ID</th>
                        <th >Application Date</th>
                        <th >Approved Date</th>
                        <th >Owner/Care Taker</th>
                        <th style="text-align: center;">No. Of Pets</th>
                        <th >Sent Date</th>
                        <th >Sent Method</th>
                        <th style="text-align: center;">Tracking#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td >
                            @if(getSiteSettings('alt_id_true') == 'true')<?php echo "IE" . str_pad($app->alt_id, 5, "0", STR_PAD_LEFT); ?>@else {{$app->id}} @endif
                        </td>
                        <td >{{date('m/d/Y',strtotime($app->application_date))}}</td>
                        <td >{{date('m/d/Y',strtotime($app->approved_date))}}</td>
                        <td >{{$app->client->fname}} {{$app->client->lname}}</td>
                        <td style="text-align: center;">{{$app->pets->count()}}</td>
                        @if(isset($track->sent_date))
                        <td >{{date('m/d/Y', strtotime($track->sent_date))}}</td>
                        @else
                        <td> - </td>
                        @endif
                        @if(isset($track->sent_method))
                        <td >{{$track->sent_method}}</td>
                        @else
                        <td> - </td>
                        @endif
                        @if(isset($track->sent_tracking_no))
                        <td style="text-align: center;">{{$track->sent_tracking_no}}</td>
                        @else
                        <td > - </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>