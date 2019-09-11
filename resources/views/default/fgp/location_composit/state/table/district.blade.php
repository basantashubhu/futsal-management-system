<div>
    <div class="m-checkbox-inline">
        @if(count($districts)>0)
            <form id="StateDistrictForm">
                <input type="hidden" name="state_id" value="{{$state->id}}" />
                <div class="row">
                    @foreach($districts as $district)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <label class="m-checkbox">
                                <input type="checkbox" name="districts[]" data-name="{{$district->district_name}}" value="{{$district->id}}" class="col-md-3 col-lg-3" @if($district->state_id == $state->id) checked @endif> {{$district->district_name}}
                                <span></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        @else
            <p>No District Available</p>
        @endif
    </div>
</div>