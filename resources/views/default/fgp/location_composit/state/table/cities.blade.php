<div>
    <div class="m-checkbox-inline">
        @if($cities)
            <form id="StateCityForm">
                <input type="hidden" name="state_id" value="{{$state->id}}" />
                <div class="row">
                    @foreach($cities as $city)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <label class="m-checkbox">
                                <input type="checkbox" name="cities[]" data-name="{{$city->city_name}}" value="{{$city->id}}" class="col-md-3 col-lg-3" @if($city->state_id == $state->id) checked @endif> {{$city->city_name}}
                                <span></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        @else
            <p>No City Available</p>
        @endif
    </div>
</div>