<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title">
                Schedules
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="schedules" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Schedules
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="schedules/add" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Add
                        </span>
                    </a>
                </li>
            </ul>
        </div>


        <button type="button" class="btn m-btn m-btn--pill btn-default" data-route="schedules">
            <i class="la la-arrow-left"></i> Back
        </button>
    </div>
</div>


<style>
    .m-datatable__cell {
        text-transform: unset;
    }
    #rightSection .table th, .table td {
        padding: 0.35rem;
    }
    #rightSection  th.m-datatable__cell {
        background: #00aabd;
    }
    #rightSection  th.m-datatable__cell span {
        color: #fff;
    }
    #rightSection  td.m-datatable__cell {
        vertical-align: top;
    }
</style>


@include('default.pages.schedules.includes.addBody')

<script>
    $(function() {
        const courts = $('#CourtListForm .court').off('click').on('click', function(e) {
            const self = $(this);
            const request = {
                url: `schedules/create`,
                data: { court_id: self.attr('data-id') }
            };
            sendAjax(request, function(response) {
                $('#rightSection').html(response);
            });
        });

        if(courts.length) {
            const request = {
                url: `schedules/create`,
                data: { court_id: courts.first().attr('data-id') }
            };
            sendAjax(request, function(response) {
                $('#rightSection').html(response);
            });
        }
    });
</script>