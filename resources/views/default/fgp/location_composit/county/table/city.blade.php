<div>
    <div class="m-checkbox-inline row">
        @if($cities)

            <form id="CountyCityForm">
                <input type="hidden" name="county_id" value="{{$county->id}}" />

                @foreach($cities as $city)
                    <label class="m-checkbox col-12 col-sm-6 col-md-3 col-lg-3">
                        <input type="checkbox" name="cities[]" value="{{$city->id}}" class="col-md-3 col-lg-3" @if($city->county_id == $county->id) checked @endif> {{$city->city_name}}
                        <span></span>
                    </label>
                @endforeach
            </form>
        @else
            <p>No City Availble</p>
        @endif
    </div>
</div>