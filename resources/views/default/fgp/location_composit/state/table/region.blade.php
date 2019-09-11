<div>
    <div class="m-checkbox-inline">
        @if(count($regions)>0)
            <form id="StateRegionForm">
                <input type="hidden" name="state_id" value="{{$state->id}}" />
                <div class="row">
                    @foreach($regions as $region)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <label class="m-checkbox">
                                <input type="checkbox" name="regions[]" data-name="{{$region->region_name}}" value="{{$region->id}}" class="col-md-3 col-lg-3" @if($region->state_id == $state->id) checked @endif> {{$region->region_name}}
                                <span></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        @else
            <p>No Region Available</p>
        @endif
    </div>
</div>