<?php

?>
@include('default.fgp.program_setup.includes.header')


<div class="m-content">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="m-portlet m-portlet--mobile with-border">
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-portlet no-m-i m-portlet--bordered-semi" style="border: unset;">
                        <div class="m-portlet__body clearfix">
                            <div>
                                <div style="width: 150px;">
                                    <img src="/{{ program($properties, 'logo', 'images/logo.png') }}" alt="logo" class="img-fluid">
                                </div>
                            </div>
                            <br>
                            <div>
                                <h4>{{ program($properties, 'site_title', 'Foster Grandparents Program') }}</h4>
                            </div>
                            <br>
                            @foreach($properties as $property)
                                <div class="row">
                                    {{--<div class="col-md-4">{{ $property->property }}</div>--}}
                                    <div class="col-md-12">{{ $property->value?:$property->value2 }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-8">
            <div class="m-portlet m-portlet--mobile with-border">
                <div class="m-portlet__body">
                    <fieldset>
                        <legend>Program Configuration
                            <span class="btn btn-sm m-btn--pill float-right btn-info" data-modal-route="/program/properties/new">
                                <i class="la la-plus"></i> Add New
                            </span>
                        </legend>
                        <div>
                            <table id="programConfiguration"></table>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        let dataTable = $('#programConfiguration').mDatatable({
            data : {
                type: 'remote',
                source: {
                    read: {
                        url: '/program/new-properties',
                        method:'GET'
                    },
                }
            },
            columns: [
                {
                    field:'property',
                    title:'Property',
                    width: '150px'
                },
                {
                    field:'value',
                    title:'Value',
                    template: function (raw) {
                        return raw.value ? raw.value : raw.value2;
                    }
                },
                {
                    field:'action',
                    title:'Actions',
                    width: '50px',
                    template: function(raw) {
                        return [
                            '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"'+
                            ' data-modal-route="/program/properties/'+ raw.id +'/update">' +
                            '<i class="la la-edit"></i></button>'
                        ].join('');
                    }
                }
            ]
        });
    });
</script>