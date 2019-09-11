<?php


return [
    'top_nav' => [
//        'Menu' => [
        //            [
        //                'label' => 'Menu',
        //                'sub-menu' => [
        //                    [
        //                        'name' => 'Calendar',
        //                        'icon' => 'm-menu__link-icon flaticon-calendar-3',
        //                        'url' => 'calendar',
        //                        'access' => ['calendar', 'view']
        //                    ],
        //                    [
        //                        'name' => 'Calendar1',
        //                        'icon' => 'm-menu__link-icon flaticon-calendar-3',
        //                        'url' => 'calendar1',
        //                        'access' => ['calendar1', 'view']
        //                    ],
        //                ]
        //            ]
        //        ],
        'Reports' => [
            [
                'label' => 'Reports',
                'access' => ['reports', 'view'],
                'sub-menu' => [
                    [
                        'name' => 'Reports',
                        'icon' => 'm-menu__link-icon flaticon-dashboard',
                        'url' => 'reports',
                    ],
                ],
            ],
        ],
        'Settings' => [
            [
                'label' => 'System Management',
                'sub-menu' => [
                    [
                        'name' => 'User Logs',
                        'url' => 'userlogs',
                        'icon' => 'm-menu__link-icon flaticon-cogwheel-2',
                        'access' => ['user settings', 'view'],
                    ],
                    [
                        'name' => 'User Control',
                        'url' => 'user',
                        'icon' => 'm-menu__link-icon flaticon-user-settings',
                        'access' => ['user control', 'view'],
                    ],
                    [
                        'name' => 'Role Management',
                        'url' => 'roleManagement',
                        'icon' => 'm-menu__link-icon flaticon-interface-6',
                        'access' => ['role management', 'view'],
                    ],
                    [
                        'name' => 'Site Settings',
                        'url' => 'site_settings',
                        'icon' => 'm-menu__link-icon flaticon-settings',
                        'access' => ['site settings', 'view'],

                    ],
                    [
                        'name' => 'Support',
                        'icon' => 'm-menu__link-icon flaticon-notes',
                        'url' => 'developernote',
                        'access' => ['support', 'view'],
                    ],
                    [
                        'name' => 'Table Maintenance',
                        'url' => 'maintenance',
                        'icon' => 'm-menu__link-icon flaticon-confetti',
                        'access' => ['maintenance', 'view'],
                    ],
                ],
            ],
            [
                'label' => 'Log',
                'sub-menu' => [
                    // [
                    //     'name' => 'Text Log',
                    //     'url' => 'textLog',
                    //     'icon' => 'm-menu__link-icon flaticon-file-1',
                    //     'access' => ['text log', 'view'],
                    // ],
                    [
                        'name' => 'Email Log',
                        'url' => 'email_log',
                        'icon' => 'm-menu__link-icon flaticon-tool',
                        'access' => ['email log', 'view'],
                    ],
                    [
                        'name' => 'Audit',
                        'icon' => 'm-menu__link-icon fa fa-user-md',
                        'url' => 'audit/all',
                        'access' => ['audit', 'view'],
                    ],
                    [
                        'name' => 'Note',
                        'icon' => 'm-menu__link-icon flaticon-file',
                        'url' => 'note',
                        'access' => ['note', 'view'],
                    ],
                ],
            ], [
                'label' => 'Template',
                'sub-menu' => [
                    [
                        'name' => 'System Templates',
                        'url' => 'email_template',
                        'icon' => 'm-menu__link-icon    flaticon-interface-1',
                        'access' => ['template', 'view'],
                    ],
                    // [
                    //     'name' => 'Default Template',
                    //     'url' => 'default_template',
                    //     'icon' => 'm-menu__link-icon    flaticon-interface-4',
                    //     'access' => ['default template', 'view']
                    // ],

                ],
            ],
            [
                'label' => 'Utitilies',
                'access' => ['utilities', 'view'],
                'sub-menu' => [
                    [
                        'name' => 'Backup',
                        'url' => 'database',
                        'icon' => 'm-menu__link-icon la la-database',
                        'access' => ['database backup', 'view'],
                    ],
                    [
                        'name' => 'Api Generator',
                        'url' => 'client/apigenerator',
                        'icon' => 'm-menu__link-icon fa fa-key',
                        'access' => ['database backup', 'view'],
                    ],
                    [
                        'name' => 'Layout Builder',
                        'url' => 'layout_builder',
                        'icon' => 'm-menu__link-icon flaticon-app',
                        'access' => ['layout_builder', 'view'],
                    ],
                    [
                        'name' => 'Program Setup',
                        'url' => 'program-setup',
                        'icon' => 'm-menu__link-icon fa fa-cog',
                        'access' => ['program-setup', 'view'],
                    ],
                    [
                        'name' => 'Importer',
                        'url' => 'importer',
                        'icon' => 'm-menu__link-icon  la  la-paperclip',
                        'access' => ['importer', 'view'],
                    ],
                ],
            ],
        ],
    ],
    'access' => [
        'Reports' => ['system menu', 'reports_view'],
        'Tables' => ['system menu', 'tables_view'],
        'Settings' => ['system menu', 'settings_view'],
    ],
];
