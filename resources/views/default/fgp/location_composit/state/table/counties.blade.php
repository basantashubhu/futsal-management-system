<div>
    <div class="m-checkbox-inline">
        <form id="StateCountyForm">
            @if($counties)
                    <input type="hidden" name="state_id" value="{{$state->id}}" />
                <div class="row">
                    @foreach($counties as $county)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <label class="m-checkbox">
                                <input type="checkbox" name="counties[]" value="{{$county->id}}" @if($county->state_id == $state->id) checked @endif> {{$county->county_name}}
                                <span></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No Counties Availble</p>
            @endif
        </form>
    </div>
</div>