<div class="row">
    <div class="col">
        <div class="app-col-seperator m-b-30">
            <div class="app-col-header">
                <div class="app-col-header-caption">
                    <span class="custom-header std-header">Rate Plans</span>
                </div>
                <div class="app-col-header-tool">
                    <button class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                            data-modal-route="rate_plan/add"><i class="la la-plus"></i></button>
                    <button class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                            data-modal-route="/organization/rateplan/{{$organization->id}}" title="Change Rate Plan"><i class="la la-edit"></i>
                    </button>
                </div>
            </div>
            <div class="app-col-body">
                <div class="row">
                    <div class="col-sm-12 rate_plan_lists">
                        {{--@foreach($rate_plans as $rate_plans)--}}
                        @if(isset($rate_plans))
                            <div class="m-accordion m-accordion--default m-accordion--toggle-arrow"
                                 id="m_pet_accordion_{{$rate_plans->plan_name}}" role="tablist">
                                <!--begin::Item-->
                                <div class="m-accordion__item no-m-bottom has-border">
                                    <div class="m-accordion__item-head collapsed" role="tab"
                                         id="np_rate_plan_m_pet_accordion_{{$rate_plans->plan_name}}"
                                         data-toggle="collapse"
                                         href="#np_accordionBody_m_pet_accordion_{{$rate_plans->plan_name}}"
                                         aria-expanded="false">
						            <span class="m-accordion__item-title">
						                <span class="petName">{{$rate_plans->plan_name}}</span>
						            </span>
                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse @if($rate_plans->is_active) show @else @endif"
                                         id="np_accordionBody_m_pet_accordion_{{$rate_plans->plan_name}}"
                                         role="tabpanel"
                                         aria-labelledby="np_rate_plan_m_pet_accordion_{{$rate_plans->plan_name}}"
                                         data-parent="#m_pet_accordion_{{$rate_plans->plan_name}}">
                                        <div class="m-accordion__item-content">
                                            <div class="rate_datatable" id="rate_datatable"
                                                 data-rate-id="{{$rate_plans->id}}"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Item-->
                            </div>
                            {{--@endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>