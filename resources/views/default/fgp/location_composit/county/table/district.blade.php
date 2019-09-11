<div>
    <div class="m-checkbox-inline row">
        @if(count($districts)>0)
            <form id="countyDistrictForm">
                @if($county)
                    <input type="hidden" name="county_id" value="{{$county->id}}" />
                @endif
                @foreach($districts as $district)
                    <label class="m-checkbox col-12 col-sm-6 col-md-3 col-lg-3">
                        <input type="checkbox" name="cities[]" value="{{$district->id}}" class="col-md-3 col-lg-3" @if($district->county_id == $county->id) checked @endif> {{$city->city_name}}
                        <span></span>
                    </label>
                @endforeach
            </form>
        @else
            <p>No District Availble</p>
        @endif
    </div>
</div>