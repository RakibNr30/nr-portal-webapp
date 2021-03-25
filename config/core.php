<?php

return [
    'theme' => 'theme1',
    // admin menu
    'admin_menu' => [
        [
            "name" => "Dashboard",
            "id" => "dashboard",
            "icon" => "fa-chart-line",
            "url" => "/backend/dashboard",
            "permission" => "dashboard",
            "children" => []
        ],
        [
            "name" => "My Profile",
            "id" => "my_profile",
            "icon" => "fa-user-alt",
            "url" => "/backend/profile/account-info",
            "permission" => "my_profile",
            "children" => []
        ],
        [
            "name" => "Project",
            "id" => "my_project",
            "icon" => "fa-tasks",
            "url" => "",
            "permission" => "my_project",
            "children" => [
                [
                    "name" => "Create",
                    "name_client" => "Create",
                    "name_company" => "Create",
                    "name_admin" => "Create",
                    "name_super_admin" => "Create",
                    "id" => "create_project",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/project/create",
                    "permission" => "create_project",
                ],
                [
                    "name" => "Pending",
                    "name_client" => "Pending",
                    "name_company" => "Pending",
                    "name_admin" => "Pending",
                    "name_super_admin" => "Pending",
                    "id" => "pending_project",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/project/pending",
                    "permission" => "pending_project",
                ],
                [
                    "name" => "Approved",
                    "name_client" => "In Progress",
                    "name_company" => "Assigned",
                    "name_admin" => "In Progress",
                    "name_super_admin" => "In Progress",
                    "id" => "approved_project",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/project/approved",
                    "permission" => "approved_project",
                ],
                [
                    "name" => "Accepted",
                    "name_client" => "Accepted",
                    "name_company" => "In Progress",
                    "name_admin" => "Accepted",
                    "name_super_admin" => "Accepted",
                    "id" => "accepted_project",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/project/accepted",
                    "permission" => "accepted_project",
                ]
            ]
        ],
        [
            "name" => "Client",
            "id" => "client",
            "icon" => "fa-certificate",
            "url" => "",
            "permission" => "user_controls",
            "children" => [
                [
                    "name" => "Request",
                    "id" => "client_request",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/client/request",
                    "permission" => "client_request",
                ],
                [
                    "name" => "Approved",
                    "id" => "client_approved",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/client/approved",
                    "permission" => "client_approved",
                ]
            ]
        ],
        /*[
            "name" => "Cms",
            "id" => "cms",
            "icon" => "fa-cogs",
            "url" => "",
            "permission" => "cms",
            "children" => [
                [
                    "name" => "Slider",
                    "id" => "slider",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/slider",
                    "permission" => "slider",
                ],
                [
                    "name" => "Page",
                    "id" => "page",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/page",
                    "permission" => "page",
                ],
                [
                    "name" => "Content",
                    "id" => "content",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/content",
                    "permission" => "content",
                ],
                [
                    "name" => "Faq",
                    "id" => "faq",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/faq",
                    "permission" => "faq",
                ],
                [
                    "name" => "Testimonial",
                    "id" => "testimonial",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/testimonial",
                    "permission" => "testimonial",
                ],
            ]
        ],*/
        [
            "name" => "User Controls",
            "id" => "user_controls",
            "icon" => "fa-users",
            "url" => "",
            "permission" => "user_controls",
            "children" => [
                [
                    "name" => "Admin",
                    "id" => "admin",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/admin",
                    "permission" => "admin",
                ],
                [
                    "name" => "Company",
                    "id" => "company",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/company",
                    "permission" => "company",
                ]
            ]
        ],
        /*[
            "name" => "Common Settings",
            "id" => "common_settings",
            "icon" => "fa-wrench",
            "url" => "",
            "permission" => "common_settings",
            "children" => [
                [
                    "name" => "Page Category",
                    "id" => "page_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/page-category",
                    "permission" => "page_category",
                ],
                [
                    "name" => "Content Category",
                    "id" => "content_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/content-category",
                    "permission" => "content_category",
                ],
            ]
        ],*/
        [
            "name" => "App Settings",
            "id" => "app_settings",
            "icon" => "fa-tools",
            "url" => "",
            "permission" => "app_settings",
            "children" => [
                [
                    "name" => "Site",
                    "id" => "site",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/site",
                    "permission" => "site_settings",
                ],
                [
                    "name" => "Contact",
                    "id" => "contact",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/contact",
                    "permission" => "contact_settings",
                ],
                [
                    "name" => "Seo",
                    "id" => "seo",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/seo",
                    "permission" => "seo_settings",
                ],
                [
                    "name" => "Socialite",
                    "id" => "socialite",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/socialite",
                    "permission" => "socialite_settings",
                ]
            ]
        ]
    ],
    // profile menu
    'profile_menu' => [
        [
            "name" => "Account Info",
            "id" => "account_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/account-info",
            "permission" => "account_info",
            "children" => []
        ],
        [
            "name" => "Basic Info",
            "id" => "basic_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/basic-info",
            "permission" => "basic_info",
            "children" => []
        ],
        [
            "name" => "Residential Info",
            "id" => "residential_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/residential-info",
            "permission" => "residential_info",
            "children" => []
        ],
        [
            "name" => "Social Account",
            "id" => "social_account",
            "icon" => "fa-user",
            "url" => "/backend/profile/social-account",
            "permission" => "social_account",
            "children" => []
        ],
        [
            "name" => "Change Password",
            "id" => "change_password",
            "icon" => "fa-user",
            "url" => "/backend/profile/change-password",
            "permission" => "change_password",
            "children" => []
        ]
    ],
    // front menu
    'front_menu' => [],
    "geoip2" => [
        "country_db" => resource_path('geoip/GeoLite2-Country.mmdb'),
        "city_db" => resource_path('geoip/GeoLite2-City.mmdb'),
    ],
    "blood_groups" => [
        "A+" => "A+",
        "A-" => "A-",
        "B+" => "B+",
        "B-" => "B-",
        "O+" => "O+",
        "O-" => "O-",
        "AB+" => "AB+",
        "AB-" => "AB-",
    ],
    "genders" => [
        "1" => "Male",
        "2" => "Female",
        "3" => "Others"
    ],
    // media collection
    'media_collection' => [
        'user' => [
            'avatar' => 'user_avatar',
        ],
        'user_personal_info' => [
            'image' => 'user_personal_info_image'
        ],
        'project' => [
            'image' => 'project_feature_image',
            'attachment' => 'project_attachment',

            'attachment_company_1' => 'project_attachment_company_1',
            'attachment_company_2' => 'project_attachment_company_2',
            'attachment_company_3' => 'project_attachment_company_3',
            'attachment_admin_1' => 'project_attachment_admin_1',
            'attachment_admin_2' => 'project_attachment_admin_2',
            'attachment_admin_3' => 'project_attachment_admin_3',
        ],
        'setting_site' => [
            'logo' => 'setting_site_logo',
            'logo_sm' => 'setting_site_logo_sm',
            'favicon' => 'setting_site_favicon'
        ]
    ],
    'image' => [
        'default' => [
            'logo' => '/admin/images/default/logo.png',
            'logo_sm' => '/admin/images/default/logo-sm.png',
            'favicon' => '/admin/images/default/favicon.ico',
            'avatar' => '/admin/images/default/avatar.jpeg',
        ]
    ],
    'role' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'company' => 'Company',
        'client' => 'Client'
    ]
];
