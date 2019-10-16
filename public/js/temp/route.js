new Route({
    'dashboard': {
        url: 'dashboard',
        default: true,
        callback: 'dashboardLoaded',
    },
    'calendarSchedules': {
        url: 'calendarSchedules',
        callback: 'calendarLoaded',
    },
    'organization': {
        url: 'organization',
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
    'usersettings': {
        url: 'usersettings'
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
    'maintenance': {
        url: 'maintenance'
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
    'courts' : {}
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

