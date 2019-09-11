@if(isset($finance->id))
<div class="m-widget4" style="padding: 0.2rem; margin-top: -20px;">
@if(isset($finance->stipend_period))
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
            <i class="fa fa-exchange"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
                Period Number: 
            </span><br>
            <span class="m-widget4__sub">
            {{date('m/d/Y', strtotime($finance->stipend_period->start_date))}} - {{date('m/d/Y', strtotime($finance->stipend_period->end_date))}}
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">{{$finance->stipend_period->period_no}}</span>
        </span>
    </div>
        {{--{{ dd($finance) }}--}}
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
            <i class="fa fa-sitemap"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
                Sites
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">{{ $finance->stipend_period->sites->count() }}</span>
        </span>
    </div>
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
        <i class="fa fa-group"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
            Volunteer
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">{{ $finance->stipend_period->volunteers->count() }}</span>
        </span>
    </div>
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
        <i class="fa fa-clock-o"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
            {{$systemVariables['hoursType'] ?? 'Hours'}}
            </span>
        </div>

        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">
                {{ total_hrs($finance->time_total) }}
            </span>
        </span>
    </div>
    @if(auth()->user()->role->name!=="supervisor")
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
        <i class="fa fa-money"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
            Total Time 
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">${{number_format($finance->time_total_amt, 2)}}</span>
        </span>
    </div>
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
        <i class="fa fa-money"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
            Total Items
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">${{number_format($finance->amt_total, 2)}}</span>
        </span>
    </div>
    <div class="m-widget4__item" style="padding-top: 0.6rem; padding-bottom: 0.6rem;">
        <div class="m-widget4__img m-widget4__img--logo">
        <i class="fa fa-money"></i>
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__title">
            Total
            </span>
        </div>
        <span class="m-widget4__ext">
            <span class="m-widget4__number m--font-brand">${{number_format($finance->total, 2)}}</span>
        </span>
    </div>
    @endif
@endif
</div>
@endif