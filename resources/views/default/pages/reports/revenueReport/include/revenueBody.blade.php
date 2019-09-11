<div class="m-content">
    <div class="row">
        <div class="col-xl-6 fundStandingContainer">
            @include($viewLocation.'.partials.fundStanding')
        </div>
        <div class="col-xl-6 fundActivityContainer">
            @include($viewLocation.'.partials.fundActivity')
        </div>
    </div>

    <!-- Bar Chart-->
    <div class="row">
        <div class="col-xl-6">
            @include($viewLocation.'.partials.rabies')
        </div>
        <div class="col-xl-6">
            @include($viewLocation.'.partials.surgery')
        </div>
    </div>
</div>
