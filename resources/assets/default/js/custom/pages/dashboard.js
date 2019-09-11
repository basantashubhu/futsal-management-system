

var applicationchartdata;

function dashboardTopDateLoader() {

    var daterangepickerInit = function () {
        if ($('#m_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#m_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);
        }

        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    daterangepickerInit();
}

function loadDashboardPortlet() {

    var PortletTools = function () {
        //== Toastr
        var initToastr = function () {
            toastr.options.showDuration = 1000;
        }

        //== Demo 1
        var demo1 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_1').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    overlayColor: '#ffffff',
                    type: 'loader',
                    state: 'accent',
                    opacity: 0.3,
                    size: 'lg'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 2
        var demo2 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_2').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    overlayColor: '#000000',
                    type: 'spinner',
                    state: 'brand',
                    opacity: 0.05,
                    size: 'lg'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });
        }

        //== Demo 3
        var demo3 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_3').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 3
        var demo4 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_4').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 3
        var demo5 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_5').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    // toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    // toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                // toastr.info('Before remove event fired!');
                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                // toastr.info('Leload event fired!');
                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }


        return {
            //main function to initiate the module
            init: function () {
                initToastr();

                // init demos
                demo1();
                demo2();
                demo3();
                demo4();
                demo5();
            }
        };
    }();

    var PortletDraggable = function () {

        return {
            //main function to initiate the module
            init: function () {
                $("#m_sortable_portlets").sortable({
                    connectWith: ".m-portlet__head",
                    items: ".m-portlet",
                    opacity: 0.8,
                    handle: '.m-portlet__head',
                    coneHelperSize: true,
                    placeholder: 'm-portlet--sortable-placeholder',
                    forcePlaceholderSize: true,
                    tolerance: "pointer",
                    helper: "clone",
                    tolerance: "pointer",
                    forcePlaceholderSize: !0,
                    helper: "clone",
                    cancel: ".m-portlet--sortable-empty", // cancel dragging if portlet is in fullscreen mode
                    revert: 250, // animation in milliseconds
                    update: function (b, c) {
                        if (c.item.prev().hasClass("m-portlet--sortable-empty")) {
                            c.item.prev().before(c.item);
                        }
                    }
                });
            }
        };
    }();

    PortletTools.init();
    PortletDraggable.init();

}

/**
 * Load Dashboard Datatable
 */
function loadDashboardDataTable() {

    // Datatable 1
    if ($('#m_datatable_latest_orders').length === 0) {
        return;
    }

    var dashboardDatatable = $('#m_datatable_latest_orders').mDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: 'https://keenthemes.com/metronic/preview/inc/api/datatables/demos/default.php'
                }
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: true
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },

        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 455,
            footer: false
        },

        sortable: true,

        filterable: false,

        pagination: true,

        columns: [{
            field: "RecordID",
            title: "#",
            sortable: false,
            width: 40,
            selector: {
                class: 'm-checkbox--solid m-checkbox--brand'
            },
            textAlign: 'center'
        }, {
            field: "OrderID",
            title: "Order ID",
            sortable: 'asc',
            filterable: false,
            width: 150,
            template: '{{OrderID}} - {{ShipCountry}}'
        }, {
            field: "ShipName",
            title: "Ship Name",
            width: 150,
            responsive: {
                visible: 'lg'
            }
        }, {
            field: "Status",
            title: "Status",
            width: 100,
            // callback function support for column rendering
            template: function (row) {
                var status = {
                    1: {
                        'title': 'Pending',
                        'class': 'm-badge--brand'
                    },
                    2: {
                        'title': 'Delivered',
                        'class': ' m-badge--metal'
                    },
                    3: {
                        'title': 'Canceled',
                        'class': ' m-badge--primary'
                    },
                    4: {
                        'title': 'Success',
                        'class': ' m-badge--success'
                    },
                    5: {
                        'title': 'Info',
                        'class': ' m-badge--info'
                    },
                    6: {
                        'title': 'Danger',
                        'class': ' m-badge--danger'
                    },
                    7: {
                        'title': 'Warning',
                        'class': ' m-badge--warning'
                    }
                };
                return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
            }
            // }, {
            //     field: "Type",
            //     title: "Type",
            //     width: 100,
            //     // callback function support for column rendering
            //     template: function(row) {
            //         var status = {
            //             1: {
            //                 'title': 'Online',
            //                 'state': 'danger'
            //             },
            //             2: {
            //                 'title': 'Retail',
            //                 'state': 'primary'
            //             },
            //             3: {
            //                 'title': 'Direct',
            //                 'state': 'accent'
            //             }
            //         };
            //         return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
            //     }
        }
            , {
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: false,
                overflow: 'visible',
                template: function (row) {
                    var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div class="dropdown ' + dropup + '">\
                        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                            <i class="la la-ellipsis-h"></i>\
                        </a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
                            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
                        </div>\
                    </div>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
                        <i class="la la-edit"></i>\
                    </a>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                }
            }]
    });

    // Datatable 2
    if ($('#m_datatable_latest_orders2').length === 0) {
        return;
    }

    var dashboardDatatable2 = $('#m_datatable_latest_orders2').mDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: 'https://keenthemes.com/metronic/preview/inc/api/datatables/demos/default.php'
                }
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: true
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },

        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 455,
            footer: false
        },

        sortable: true,

        filterable: false,

        pagination: true,

        columns: [{
            field: "RecordID",
            title: "#",
            sortable: false,
            width: 40,
            selector: {
                class: 'm-checkbox--solid m-checkbox--brand'
            },
            textAlign: 'center'
        }, {
            field: "OrderID",
            title: "Order ID",
            sortable: 'asc',
            filterable: false,
            width: 150,
            template: '{{OrderID}} - {{ShipCountry}}'
        }, {
            field: "ShipName",
            title: "Ship Name",
            width: 150,
            responsive: {
                visible: 'lg'
            }
        }, {
            field: "Status",
            title: "Status",
            width: 100,
            // callback function support for column rendering
            template: function (row) {
                var status = {
                    1: {
                        'title': 'Pending',
                        'class': 'm-badge--brand'
                    },
                    2: {
                        'title': 'Delivered',
                        'class': ' m-badge--metal'
                    },
                    3: {
                        'title': 'Canceled',
                        'class': ' m-badge--primary'
                    },
                    4: {
                        'title': 'Success',
                        'class': ' m-badge--success'
                    },
                    5: {
                        'title': 'Info',
                        'class': ' m-badge--info'
                    },
                    6: {
                        'title': 'Danger',
                        'class': ' m-badge--danger'
                    },
                    7: {
                        'title': 'Warning',
                        'class': ' m-badge--warning'
                    }
                };
                return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
            }
            // }, {
            //     field: "Type",
            //     title: "Type",
            //     width: 100,
            //     // callback function support for column rendering
            //     template: function(row) {
            //         var status = {
            //             1: {
            //                 'title': 'Online',
            //                 'state': 'danger'
            //             },
            //             2: {
            //                 'title': 'Retail',
            //                 'state': 'primary'
            //             },
            //             3: {
            //                 'title': 'Direct',
            //                 'state': 'accent'
            //             }
            //         };
            //         return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
            //     }
        }, {
            field: "Actions",
            width: 110,
            title: "Actions",
            sortable: false,
            overflow: 'visible',
            template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                return '\
                    <div class="dropdown ' + dropup + '">\
                        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                            <i class="la la-ellipsis-h"></i>\
                        </a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
                            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
                        </div>\
                    </div>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
                        <i class="la la-edit"></i>\
                    </a>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
            }
        }]
    });


    // dashboardDatatable();
    // dashboardDatatable2();
}

/**
 * Charts
 * ---------------
 * Profit
 * Trends
 */
function loadDashboardChart() {

    //== Profit Share Chart.
    var profitShare = function () {
        if ($('#m_chart_profit_share').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'service_provider/chart'
        }, function (response) {
            var chartData = response.data;
            $('#service_provider').text(chartData[0].value + '% Total Service Provider');
            $('#non_profit').text(chartData[1].value + '% Total Non Profit');
            $('#rescue').text(chartData[2].value + '% Total Rescue');
            var chart = new Chartist.Pie('#m_chart_profit_share', {

                series: [{
                    value: chartData[0].value,
                    className: 'custom',
                    meta: {
                        color: mUtil.getColor('accent')
                    }
                },
                    {
                        value: chartData[1].value,
                        className: 'custom',
                        meta: {
                            color: mUtil.getColor('warning')
                        }
                    },
                    {
                        value: chartData[2].value,
                        className: 'custom',
                        meta: {
                            color: mUtil.getColor('brand')
                        }
                    }
                ],
                labels: [1, 2, 3]
            }, {
                donut: true,
                donutWidth: 17,
                showLabel: false
            });

            chart.on('draw', function (data) {
                if (data.type === 'slice') {
                    // Get the total path length in order to use for dash array animation
                    var pathLength = data.element._node.getTotalLength();

                    // Set a dasharray that matches the path length as prerequisite to animate dashoffset
                    data.element.attr({
                        'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                    });

                    // Create animation definition while also assigning an ID to the animation for later sync usage
                    var animationDefinition = {
                        'stroke-dashoffset': {
                            id: 'anim' + data.index,
                            dur: 1000,
                            from: -pathLength + 'px',
                            to: '0px',
                            easing: Chartist.Svg.Easing.easeOutQuint,
                            // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
                            fill: 'freeze',
                            'stroke': data.meta.color
                        }
                    };

                    // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
                    if (data.index !== 0) {
                        animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                    }

                    // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us

                    data.element.attr({
                        'stroke-dashoffset': -pathLength + 'px',
                        'stroke': data.meta.color
                    });

                    // We can't use guided mode as the animations need to rely on setting begin manually
                    // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
                    data.element.animate(animationDefinition, false);
                }
            });

            // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
            chart.on('created', function () {
                if (window.__anim21278907124) {
                    clearTimeout(window.__anim21278907124);
                    window.__anim21278907124 = null;
                }
                window.__anim21278907124 = setTimeout(chart.update.bind(chart), 15000);
            });


        });

    }
    profitShare();
    //== Revenue Change.
    //** Based on Morris plugin - http://morrisjs.github.io/morris.js/


    var serviceProvider = function () {
        if ($('#service_provider_chart').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'service_provider/chart'
        }, function (response) {
            var chartData = response.data;
            applicationchartdata = [];
            $.each(chartData, function (idx, value) {
                if (idx != 3) {

                    applicationchartdata[idx] = value
                }
            });
            var appchart = Morris.Donut({
                element: 'service_provider_chart',
                data: applicationchartdata,
                colors: [
                    mUtil.getColor('warning'),
                    mUtil.getColor('success'),
                    mUtil.getColor('metal')
                ],
            });
            appchart.select(0);

            // $('#totalApplication').text("Total Applications :" + chartData[3].value);
        });
    }
    serviceProvider();

    //== Daily Sales chart.
    //** Based on Chartjs plugin - http://www.chartjs.org/
    var dailySales = function () {
        var chartContainer = $('#m_chart_daily_sales');

        if (chartContainer.length == 0) {
            return;
        }
        ajaxRequest({
            url: 'invoice/chart'
        }, function (response) {
            var responsedata = response.data;


            var chartData = {
                labels: responsedata.label,
                datasets: [{
                    //label: 'Dataset 1',
                    backgroundColor: mUtil.getColor('success'),
                    data: responsedata.amount
                }, {
                    //label: 'Dataset 2',
                    backgroundColor: '#f3f3fb',
                    data: responsedata.amount
                }]
            };

            var chart = new Chart(chartContainer, {
                type: 'bar',
                data: chartData,
                options: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        intersect: false,
                        mode: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false,
                            stacked: true
                        }],
                        yAxes: [{
                            display: false,
                            stacked: true,
                            gridLines: false
                        }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        });
    }
    dailySales();
    //== Trends Stats
    var trendsStats = function () {
        if ($('#m_chart_trends_stats').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_chart_trends_stats").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: '#d2f5f9', // Put the gradient here as a fill color
                    borderColor: mUtil.getColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mUtil.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 32, 18, 15, 22, 8, 6,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 24, 21, 13, 15, 27, 29, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    //== Trends Stats 2.
    var trendsStats2 = function () {
        if ($('#m_chart_trends_stats_2').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_chart_trends_stats_2").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: '#d2f5f9', // Put the gradient here as a fill color
                    borderColor: mUtil.getColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mUtil.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 32, 18, 15, 22, 8, 6,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 24, 21, 13, 15, 27, 29, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    trendsStats();
    trendsStats2();
}


var stickyParent = "#dashboardItems";
var order = 1;
$(document).off('click', '*[rel=minimizeDiv]').on('click', '*[rel=minimizeDiv]', function (e) {
    e.preventDefault();
    var self = $(this),
        div = self.attr("data-parent");
    if (div) {
        var list = '<li class="m-nav-sticky__item c-p" rel="maximizeDiv" data-toggle="m-tooltip" title="' + $(div).find('.m-portlet__head-text').html() + '"\
						data-order="' + order + '" data-placement="left" data-original-title="' + $(div).find('.m-portlet__head-text').html() + '">' +
            $(div).find('.m-portlet__head-icon').html() + '</li>';

        $(div).attr("data-order", order).fadeOut("slow", function () {
            $(stickyParent).append(list).hide().fadeIn("slow");
        });
        order++;
    }

});

$(document).off('click', '*[rel=maximizeDiv]').on('click', '*[rel=maximizeDiv]', function (e) {
    e.preventDefault();
    var self = $(this),
        order = self.attr("data-order");
    if (order) {
        $(".m-portlet[data-order=" + order + "]").removeAttr("data-order").fadeIn("slow", function () {
            self.fadeOut("slow").remove();
        });
    }
});