@include('default.fgp.reports.finance.partials.head')
<div class="m-content">
        <div class="row">
            <div class="col-lg-12" id="dynamicFinanceController">
                @includeif('default.fgp.finance.includes.partial.'. $view)
            </div>
            <div class="col-lg-12">
                <div id="dynamicTimesheet"></div>
            </div>
        </div>
    </div>