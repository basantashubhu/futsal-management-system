new Route({
    'dashboard': {
        url: 'dashboard',
        default: true,
        callback: 'dashboardLoaded',
    },
    'dashboard1': {
        url: 'dashboard1',
        callback: 'dashboardLoaded',
    },
    'dashboard2': {
        url: 'dashboard2',
        callback: 'dashboardLoaded',
    },
    'calendar': {
        url: 'calendar',
        callback: 'calendarLoaded',
    },
    'calendar1': {
        url: 'calendar1',
        callback: 'calendarLoaded',
    },
    'schedules': {
        url: 'schedules'
    }
    ,
    'calendarSchedules': {
        url: 'calendarSchedules',
        callback: 'calendarLoaded',
    },
    'organization': {
        url: 'organization',
    },
    'client': {
        url: 'client'
    },
    'note': {
        url: 'note',
        callback: 'dashboardNoteLoaded'
    },
    'developernote': {
        url: 'developernote',
    },
    'lookup': {
        url: 'lookup',
    },
    'lookup/singleView/{id}': {
        parentRoute: 'lookup',
        container: '#singleLookup'
    },
    'volunteers': {
        url: 'volunteers'
    },

    'payperiod': {
        url: 'payperiod'
    },

    'sites': {
        url: 'sites'
    },

    'holiday': {
        url: 'holiday'
    },
    'zip_code': {
        url: 'zip_code',
    },
    'site_settings': {
        url: 'site_settings'
    },
    'validation': {
        url: 'validation',
    },
    'volunteer/schedule': {
        url: 'volunteer/schedule',
    },
    'validation/singleView/{id}': {
        parentRoute: 'validation',
        container: '#singleValidation'
    },
    'roleManagement': {
        url: 'roleManagement',
    },
    'pages': {
        url: 'pages',
        parentRoute: 'roleManagement',
        container: '#role_permission_container',
        callback: 'pageLoaded',
        class: 'active-menu'
    },
    'role': {
        url: 'role',
        parentRoute: 'roleManagement',
        container: '#role_permission_container',
        class: 'active-menu'
    },
    'permission': {
        url: 'permission',
        parentRoute: 'roleManagement',
        container: '#role_permission_container',
        class: 'active-menu'
    },
    'rolePermission': {
        url: 'rolePermission',
        parentRoute: 'roleManagement',
        container: '#role_permission_container',
        class: 'active-menu'
    },
    'userPermission': {
        url: 'userPermission',
        parentRoute: 'roleManagement',
        container: '#role_permission_container',
        class: 'active-menu'
    },
    'user': {
        url: 'user'
    },
    'userProfile/{id}': {},
    'profile': {
        url: 'userProfile'
    },
    'userProfile': {},
    'email_log': {
        url: 'email_log'
    },
    'email_template': {
        url: 'email_template'
    },
    'default_template': {
        url: 'default_template'
    },
    'volTemplate': {
        url: 'volTemplate'
    },
    'usersettings': {
        url: 'usersettings'
    },
    'textLog': {
        url: 'textLog'
    },
    'application/detail/sandbox': {
        url: 'application/detail/sandbox'
    },
    'application_np/detail/sandbox': {
        url: 'application_np/detail/sandbox'
    },
    'database': {
        url: 'database'
    },
    'mailletters': {
        url: 'mailletters'
    },
    'nonProfitStatus-step2': {
        url: 'nonProfitStatus-step2',
        container: '#process'
    },
    'addNp': {
        url: 'addNp'
    },
    'tableDemo': {
        url: 'tableDemo'
    },
    'agreementDemo': {
        url: 'agreementDemo'
    },
    'temp-np': {
        url: 'temp-np'
    },
    'service-provider': {},
    'userlogs': {
        url: 'userlogs'
    },
    'treatment': {
        url: 'treatment'
    },
    'certificate_queue': {
        url: 'certificate_queue'
    },
    'email_queue': {
        url: 'email_queue'
    },
    'postMail': {
        url: 'postMail'
    },
    'importer': {
        url: 'importer'
    },
    'layout_builder': {},
    'payment': {
        url: 'payment'
    },
    'ledger': {
        url: 'ledger'
    },
    'report/revenue': {
        url: 'report/revenue',
    },
    'sp_application': {
        url: 'sp_application',
    },
    'sp_serviceQueue': {
        url: 'sp_serviceQueue',
    },
    'sp_invoice': {
        url: 'sp_invoice',
    },
    'sp_reports': {
        url: 'sp_reports',
    },
    'sp_certificateQueue': {
        url: 'sp_certificateQueue'
    },
    'sp_vets': {
        url: 'sp_vets'
    },
    'sp_statement': {
        url: 'sp_statement'
    },
    'sp_searchByStatus/{value}': {
    },
    'client/apigenerator': {
        url: 'client/apigenerator',
    },
    'reports/pet': {
        url: 'reports/pet',
    },
    'report/treatment': {
        url: 'report/treatment',
    },
    'reports': {
        url: 'reports'
    },
    'legacy/ie': {
        url: 'legacy/ie'
    },
    'legacy/provider': {
        url: 'legacy/provider'
    },
    'budget': {
        url: 'budget'
    },
    'audit/all': {
        url: 'audit/all'
    },
    'report/support': {
        url: 'report/support'
    },
    'support': {
        url: 'support'
    },
    'support/add': {
        url: 'support/add',
        parentRoute: 'support',
        container: '#singleSupport',
    },
    'sendSupportUrl/{id}': {
        parentRoute: 'support',
        container: '#support-holder-url',
    },
    'support/viewSingle/{id}': {
        parentRoute: 'support',
        container: '#singleSupport',
    },
    'page': {
        url: 'page',
    },
    'post': { url: 'post' },
    'media': { url: 'media' },
    'component': { url: 'component' },
    'maintenance': {
        url: 'maintenance'
    },
    'view/volunteer/{volunteer}': {},
    'view/vol/{volunteer}': {},
    'time-sheets': {
        url: 'time-sheets'
    },
    'time-sheets/v2': {
        url: 'time-sheets/v2'
    },
    // 'time-sheets/add/new':{
    //     url: 'time-sheets/add/new'
    // },
    'time-sheets1': {
        url: 'time-sheets1'
    },
    'stipend/items': {
        url: 'stipend/items'
    },
    'stipend/time/items': {
        url: 'stipend/time/items'
    },
    'view/location': {
        url: 'view/location'
    },
    'location/upload': {

    },
    'location/state': {
        url: 'location/state'
    },
    'location/region': {
        url: 'location/region'
    },
    'location/district': {
        url: 'location/district'
    },
    'location/city': {
        url: 'location/city'
    },
    'location/county': {
        url: 'location/county'
    },
    'program-setup': {
        url: 'program-setup'
    },
    'organizations': {
        url: 'organizations'
    },
    'fgp_reports': {
        url: 'fgp_reports'
    },
    'fgp_reports/{type}': {
    },
    'fgp_reports/finance/{view}': {
    },
    'annual_vsy': {},
    'vsy_unit': {},
    'approval/flow': {
        url: 'approval/flow'
    },
    'finance': {
        url: 'finance'
    },
    'highVolumeHeaders': {
        url: 'highVolumeHeaders'
    },
    'hvs': {
        url: 'hvs'
    }

});

function dashboardLoaded(response) {
    dashboardTopDateLoader();
    loadDashboardPortlet();
    loadDashboardDataTable();
    loadDashboardChart();
}

// Run after calendar Load
function calendarLoaded(response) {
    fullCalendarInit();
}

function dashboardNoteLoaded(response) {
    // console.log("Dashboard note loaded");
}

