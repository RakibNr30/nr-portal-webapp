<?php

return [
    'theme' => 'theme1',
    // admin menu
    'admin_menu' => [
        [
            "name" => "Dashboard",
            "name_dt" => "Dashboard",
            "id" => "dashboard",
            "icon" => "fa-chart-line",
            "url" => "/backend/dashboard",
            "permission" => "dashboard",
            "children" => []
        ],
        [
            "name" => "My Profile",
            "name_dt" => "Mijn profiel",
            "id" => "my_profile",
            "icon" => "fa-user-alt",
            "url" => "/backend/profile/account-info",
            "permission" => "my_profile",
            "children" => []
        ],
        [
            "name" => "Create Project",
            "name_dt" => "Offerte aanvragen",
            "name_client" => "Create Project",
            "name_client_dt" => "Offerte aanvragen",
            "name_company" => "Create Project",
            "name_company_dt" => "Offerte aanvragen",
            "name_admin" => "Create Project",
            "name_admin_dt" => "Offerte aanvragen",
            "name_super_admin" => "Create Project",
            "name_super_admin_dt" => "Offerte aanvragen",
            "id" => "project",
            "icon" => "fa-plus-circle",
            "url" => "/backend/project/create",
            "permission" => "create_project",
        ],
        [
            "name" => "My Projects",
            "name_dt" => "Mijn aanvragen",
            "name_client" => "My Projects",
            "name_client_dt" => "Mijn aanvragen",
            "name_company" => "My Projects",
            "name_company_dt" => "Mijn aanvragen",
            "name_admin" => "",
            "name_admin_dt" => "",
            "name_super_admin" => "",
            "name_super_admin_dt" => "",
            "id" => "project",
            "icon" => "fa-check-circle",
            "url" => "/backend/my-project",
            "permission" => "my_projects",
        ],
        [
            "name" => "Pending Projects",
            "name_dt" => "Nieuwe aanvragen",
            "name_client" => "Pending Projects",
            "name_client_dt" => "Nieuwe aanvragen",
            "name_company" => "Pending Projects",
            "name_company_dt" => "Nieuwe aanvragen",
            "name_admin" => "Pending Projects",
            "name_admin_dt" => "Nieuwe aanvragen",
            "name_super_admin" => "Pending Projects",
            "name_super_admin_dt" => "Nieuwe aanvragen",
            "id" => "project",
            "icon" => "fa-ban",
            "url" => "/backend/project/pending",
            "permission" => "pending_project",
        ],
        [
            "name" => "Approved Projects",
            "name_dt" => "Approved Projects",
            "name_client" => "In Progress Projects",
            "name_client_dt" => "In offertefase",
            "name_company" => "Assigned Projects",
            "name_company_dt" => "Toegewezen aanvragen",
            "name_admin" => "In Progress Projects",
            "name_admin_dt" => "In offertefase",
            "name_super_admin" => "In Progress Projects",
            "name_super_admin_dt" => "In offertefase",
            "id" => "project",
            "icon" => "fa-spinner",
            "url" => "/backend/project/approved",
            "permission" => "approved_project",
        ],
        [
            "name" => "Accepted Projects",
            "name_dt" => "Geaccepteerde aanvragen",
            "name_client" => "Accepted Projects",
            "name_client_dt" => "Geaccepteerde aanvragen",
            "name_company" => "In Progress Projects",
            "name_company_dt" => "In offertefase",
            "name_admin" => "Accepted Projects",
            "name_admin_dt" => "Geaccepteerde aanvragen",
            "name_super_admin" => "Accepted Projects",
            "name_super_admin_dt" => "Geaccepteerde aanvragen",
            "id" => "project",
            "icon" => "fa-check-circle",
            "url" => "/backend/project/accepted",
            "permission" => "accepted_project",
        ],
        [
            "name" => "Client Request",
            "name_dt" => "Nieuwe klanten",
            "id" => "client_request",
            "icon" => "fa-user-plus",
            "url" => "/backend/client/request",
            "permission" => "client_request",
        ],
        [
            "name" => "Clients",
            "name_dt" => "Klant",
            "id" => "clients",
            "icon" => "fa-user-friends",
            "url" => "/backend/client/approved",
            "permission" => "client_approved",
        ],
        [
            "name" => "Companies",
            "name_dt" => "Bedrijven",
            "id" => "companies",
            "icon" => "fa-industry",
            "url" => "/backend/company",
            "permission" => "company",
        ],
        [
            "name" => "User Controls",
            "name_dt" => "Gebruikers beheren",
            "id" => "user_controls",
            "icon" => "fa-users-cog",
            "url" => "",
            "permission" => "user_controls",
            "children" => [
                [
                    "name" => "Admin",
                    "name_dt" => "Admin",
                    "id" => "admin",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/admin",
                    "permission" => "admin",
                ]
            ]
        ],
        [
            "name" => "App Settings",
            "name_dt" => "Instellingen",
            "id" => "app_settings",
            "icon" => "fa-tools",
            "url" => "",
            "permission" => "app_settings",
            "children" => [
                [
                    "name" => "Site",
                    "name_dt" => "Website",
                    "id" => "site",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/site",
                    "permission" => "site_settings",
                ],
                /*[
                    "name" => "Contact",
                    "id" => "contact",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/contact",
                    "permission" => "contact_settings",
                ],*/
                [
                    "name" => "Seo",
                    "name_dt" => "SEO",
                    "id" => "seo",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/seo",
                    "permission" => "seo_settings",
                ],
                /*[
                    "name" => "Socialite",
                    "id" => "socialite",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/socialite",
                    "permission" => "socialite_settings",
                ]*/
            ]
        ],
        [
            "name" => "Mail Template",
            "name_dt" => "E-mails",
            "id" => "mail_settings",
            "icon" => "fa-envelope-open-text",
            "url" => "/backend/mail-template",
            "permission" => "mail_settings",
            "children" => []
        ]
    ],
    // profile menu
    'profile_menu' => [
        [
            "name" => "Account Info",
            "name_dt" => "Accountinformatie",
            "id" => "account_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/account-info",
            "permission" => "account_info",
            "children" => []
        ],
        [
            "name" => "Basic Info",
            "name_dt" => "Algemene informatie",
            "id" => "basic_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/basic-info",
            "permission" => "basic_info",
            "children" => []
        ],
        [
            "name" => "Residential Info",
            "name_dt" => "Extra informatie",
            "id" => "residential_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/residential-info",
            "permission" => "residential_info",
            "children" => []
        ],
        [
            "name" => "Change Password",
            "name_dt" => "Wachtwoord veranderen",
            "id" => "change_password",
            "icon" => "fa-user",
            "url" => "/backend/profile/change-password",
            "permission" => "change_password",
            "children" => []
        ]
    ],
    // front menu
    'front_menu' => [],
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
        'admin_dt' => 'Admin',
        'company' => 'Company',
        'company_dt' => 'bedrijf',
        'client' => 'Client',
        'client_dt' => 'Klant'
    ],
    'project_paginate' => [
        'pending' => [
            'super_admin' => 'Pending',
            'super_admin_dt' => 'Nieuwe aanvraag',
            'admin' => 'Pending',
            'admin_dt' => 'Nieuwe aanvraag',
            'client' => 'Pending',
            'client_dt' => 'Nieuwe aanvraag',
            'company' => 'Pending',
            'company_dt' => 'Nieuwe aanvraag',
        ],
        'approved' => [
            'super_admin' => 'In Progress',
            'super_admin_dt' => 'In offerte fase',
            'admin' => 'In Progress',
            'admin_dt' => 'In offerte fase',
            'client' => 'In Progress',
            'client_dt' => 'In offerte fase',
            'company' => 'Assigned',
            'company_dt' => 'Toegewezen',
        ],
        'accepted' => [
            'super_admin' => 'Accepted',
            'super_admin_dt' => 'Geaccepteerd',
            'admin' => 'Accepted',
            'admin_dt' => 'Geaccepteerd',
            'client' => 'Accepted',
            'client_dt' => 'Geaccepteerd',
            'company' => 'In Progress',
            'company_dt' => 'In offerte fase',
        ]
    ],
    'mail_category' => [
        '1' => 'Client Approval',
        '2' => 'Admin Creation',
        '3' => 'Company Creation',
        '4' => 'Project Approval',
        '5' => 'Company Selection',
        '6' => 'Company Acceptation',
    ]
];
