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
            "permission" => "Dashboard",
            "children" => []
        ],
        [
            "name" => "My Profile",
            "id" => "my_profile",
            "icon" => "fa-user-circle",
            "url" => "/backend/profile/personal-info",
            "permission" => "My Profile",
            "children" => []
        ],
        [
            "name" => "Chairman Message",
            "id" => "chairman_message",
            "icon" => "fa-envelope",
            "url" => "/backend/chairman-message",
            "permission" => "Chairman Message",
            "children" => []
        ],
        [
            "name" => "Article",
            "id" => "article",
            "icon" => "fa-newspaper",
            "url" => "",
            "permission" => "Article",
            "children" => [
                [
                    "name" => "Approved Article",
                    "id" => "approved_article",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/article?type=approved",
                    "permission" => "Approved Article",
                ],
                [
                    "name" => "Pending Article",
                    "id" => "pending_article",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/article?type=pending",
                    "permission" => "Pending Article",
                ],
                [
                    "name" => "Write Article",
                    "id" => "write_article",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/article/create",
                    "permission" => "Write Article",
                ]
            ]
        ],
        /*[
            "name" => "Research",
            "id" => "research",
            "icon" => "fa-chart-area",
            "url" => "/backend/research",
            "permission" => "Research",
            "children" => []
        ],*/
        [
            "name" => "Publication",
            "id" => "publication",
            "icon" => "fa-chart-area",
            "url" => "/backend/publication",
            "permission" => "Publication",
            "children" => []
        ],
        [
            "name" => "Project",
            "id" => "project",
            "icon" => "fa-puzzle-piece",
            "url" => "/backend/project",
            "permission" => "Dashboard",
            "children" => []
        ],
        [
            "name" => "Gallery",
            "id" => "gallery",
            "icon" => "fa-photo-video",
            "url" => "/backend/gallery",
            "permission" => "Gallery",
            "children" => []
        ],
        [
            "name" => "Cms",
            "id" => "cms",
            "icon" => "fa-cogs",
            "url" => "",
            "permission" => "Cms",
            "children" => [
                [
                    "name" => "Slider",
                    "id" => "slider",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/slider",
                    "permission" => "Slider",
                ],
                [
                    "name" => "Page",
                    "id" => "page",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/page",
                    "permission" => "Page",
                ],
                [
                    "name" => "Content",
                    "id" => "content",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/content",
                    "permission" => "Content",
                ],
                [
                    "name" => "Faq",
                    "id" => "faq",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/faq",
                    "permission" => "Faq",
                ],
                [
                    "name" => "Quote",
                    "id" => "quote",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/quote",
                    "permission" => "quote",
                ],
                [
                    "name" => "Testimonial",
                    "id" => "testimonial",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/testimonial",
                    "permission" => "Testimonial",
                ],
                [
                    "name" => "Important Person",
                    "id" => "important_person",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/important-person",
                    "permission" => "Important Person",
                ],
                [
                    "name" => "Academic Calendar",
                    "id" => "academic_calendar",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/academic-calendar",
                    "permission" => "Academic Calender",
                ],
                [
                    "name" => "Class Schedule",
                    "id" => "class_schedule",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/class-schedule",
                    "permission" => "Class Schedule",
                ]
            ]
        ],
        /*[
            "name" => "Geo",
            "id" => "geo",
            "icon" => "fa-map-marked-alt",
            "url" => "",
            "permission" => "Geo",
            "children" => [
                [
                    "name" => "Country",
                    "id" => "country",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/country",
                    "permission" => "Country",
                ],
                [
                    "name" => "State",
                    "id" => "state",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/state",
                    "permission" => "State",
                ],
                [
                    "name" => "City",
                    "id" => "city",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/city",
                    "permission" => "City",
                ],
                [
                    "name" => "Division",
                    "id" => "division",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/division",
                    "permission" => "Division",
                ],
                [
                    "name" => "District",
                    "id" => "district",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/district",
                    "permission" => "District",
                ],
                [
                    "name" => "Upazila",
                    "id" => "upazila",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/upazila",
                    "permission" => "Upazila",
                ],
                [
                    "name" => "Union",
                    "id" => "union",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/union",
                    "permission" => "Union",
                ]
            ]
        ],*/
        [
            "name" => "Access Controls",
            "id" => "access_controls",
            "icon" => "fa-sliders-h",
            "url" => "",
            "permission" => "Access Controls",
            "children" => [
                [
                    "name" => "Role",
                    "id" => "role",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/role",
                    "permission" => "Role",
                ],
                [
                    "name" => "User",
                    "id" => "user",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/user",
                    "permission" => "User",
                ]
            ]
        ],
        [
            "name" => "Core Settings",
            "id" => "core_settings",
            "icon" => "fa-cog",
            "url" => "",
            "permission" => "Core Settings",
            "children" => [
                [
                    "name" => "Faculty",
                    "id" => "faculty",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/faculty",
                    "permission" => "Faculty",
                ],
                [
                    "name" => "Department",
                    "id" => "department",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/department",
                    "permission" => "Department",
                ],
                [
                    "name" => "Hall",
                    "id" => "hall",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/hall",
                    "permission" => "Hall",
                ],
                [
                    "name" => "Program",
                    "id" => "program",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/program",
                    "permission" => "Program",
                ],
                [
                    "name" => "Semester",
                    "id" => "semester",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/semester",
                    "permission" => "Semester",
                ],
                [
                    "name" => "Session",
                    "id" => "session",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/session",
                    "permission" => "Session",
                ],
                [
                    "name" => "Course",
                    "id" => "course",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/course",
                    "permission" => "Course",
                ]
            ]
        ],
        [
            "name" => "Common Settings",
            "id" => "common_settings",
            "icon" => "fa-wrench",
            "url" => "",
            "permission" => "Common Settings",
            "children" => [
                [
                    "name" => "Publisher",
                    "id" => "publisher",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/publisher",
                    "permission" => "Publisher",
                ],
                [
                    "name" => "Page Category",
                    "id" => "page_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/page-category",
                    "permission" => "Page Category",
                ],
                [
                    "name" => "Content Category",
                    "id" => "content_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/content-category",
                    "permission" => "Content Category",
                ],
                [
                    "name" => "Academic Calendar Category",
                    "id" => "academic_calendar_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/academic-calendar-category",
                    "permission" => "Academic Calendar Category",
                ],
                [
                    "name" => "Research Category",
                    "id" => "research_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/research-category",
                    "permission" => "Research Category",
                ],
                [
                    "name" => "Project Category",
                    "id" => "project_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/project-category",
                    "permission" => "Project Category",
                ],
                [
                    "name" => "Publication Category",
                    "id" => "publication_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/publication-category",
                    "permission" => "Publication Category",
                ],
                [
                    "name" => "Article Category",
                    "id" => "article_category",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/article-category",
                    "permission" => "Article Category",
                ]
            ]
        ],
        [
            "name" => "App Settings",
            "id" => "app_settings",
            "icon" => "fa-tools",
            "url" => "",
            "permission" => "App Settings",
            "children" => [
                [
                    "name" => "Site",
                    "id" => "site",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/site",
                    "permission" => "Site",
                ],
                [
                    "name" => "Contact",
                    "id" => "contact",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/contact",
                    "permission" => "Contact",
                ],
                [
                    "name" => "Seo",
                    "id" => "seo",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/seo",
                    "permission" => "Seo",
                ],
                [
                    "name" => "Socialite",
                    "id" => "socialite",
                    "icon" => "fa-arrow-right",
                    "url" => "/backend/socialite",
                    "permission" => "Socialite",
                ]
            ]
        ]
    ],
    // profile menu
    'profile_menu' => [
        [
            "name" => "Personal Info",
            "id" => "personal_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/personal-info",
            "permission" => "personal_info",
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
            "name" => "Educational Info",
            "id" => "educational_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/educational-info",
            "permission" => "educational_info",
            "children" => []
        ],
        [
            "name" => "Experience Info",
            "id" => "experience_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/work-info",
            "permission" => "experience_info",
            "children" => []
        ],
        [
            "name" => "Language",
            "id" => "language",
            "icon" => "fa-user",
            "url" => "/backend/profile/language",
            "permission" => "language",
            "children" => []
        ],
        [
            "name" => "Research Interest",
            "id" => "interest",
            "icon" => "fa-user",
            "url" => "/backend/profile/interest",
            "permission" => "interest",
            "children" => []
        ],
        [
            "name" => "Honor & Awards",
            "id" => "honor_and_awards",
            "icon" => "fa-user",
            "url" => "/backend/profile/content?category=1",
            "permission" => "content",
            "children" => []
        ],
        [
            "name" => "Areas Of Expertise",
            "id" => "areas_of_expertise",
            "icon" => "fa-user",
            "url" => "/backend/profile/content?category=2",
            "permission" => "content",
            "children" => []
        ],
        [
            "name" => "Areas Of Teaching",
            "id" => "areas_of_teaching",
            "icon" => "fa-user",
            "url" => "/backend/profile/content?category=3",
            "permission" => "content",
            "children" => []
        ],
        [
            "name" => "Ongoing Courses",
            "id" => "ongoing_courses",
            "icon" => "fa-user",
            "url" => "/backend/profile/content?category=4",
            "permission" => "content",
            "children" => []
        ],
        [
            "name" => "Skills",
            "id" => "skills",
            "icon" => "fa-user",
            "url" => "/backend/profile/content?category=5",
            "permission" => "content",
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
            "name" => "Account Info",
            "id" => "account_info",
            "icon" => "fa-user",
            "url" => "/backend/profile/account-info",
            "permission" => "account_info",
            "children" => []
        ],
        [
            "name" => "Password Change",
            "id" => "password_change",
            "icon" => "fa-user",
            "url" => "/backend/profile/password-change",
            "permission" => "password_change",
            "children" => []
        ]
    ],
    // front menu
    'front_menu' => [
        [
            "name" => "Home",
            "id" => "home",
            "icon" => "",
            "url" => "/",
            "permission" => "",
            "children" => []
        ],
        [
            "name" => "About",
            "id" => "about",
            "icon" => "",
            "url" => "",
            "permission" => "",
            "children" => [
                [
                    "name" => "Message from Department",
                    "id" => "message_from_department",
                    "icon" => "",
                    "url" => "/page/message-from-department",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Message from Chairman",
                    "id" => "message_from_chairman",
                    "icon" => "",
                    "url" => "/page/message-from-chairman",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "History of CSE, MBSTU",
                    "id" => "history_of_cse_mbstu",
                    "icon" => "",
                    "url" => "/page/history-of-cse-mbstu",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Why CSE, MBSTU?",
                    "id" => "why_cse_mbstu",
                    "icon" => "",
                    "url" => "/page/why-cse-mbstu",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Our Mission and Vision",
                    "id" => "our_mission_and_vision",
                    "icon" => "",
                    "url" => "/page/our-mission-and-vision",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Achievements",
                    "id" => "achievements",
                    "icon" => "",
                    "url" => "/page/achievements",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Facilities",
                    "id" => "facilities",
                    "icon" => "",
                    "url" => "/page/facilities",
                    "permission" => "",
                    "children" => []
                ],
            ]
        ],
        [
            "name" => "Academic",
            "id" => "academic",
            "icon" => "",
            "url" => "",
            "permission" => "",
            "children" => [
                [
                    "name" => "Program",
                    "id" => "program",
                    "icon" => "",
                    "url" => "",
                    "permission" => "",
                    "children" => [
                        [
                            "name" => "Undergraduate",
                            "id" => "under_graduate",
                            "icon" => "",
                            "url" => "/page/under-graduate-program",
                            "permission" => "",
                            "children" => []
                        ],
                        [
                            "name" => "Graduate",
                            "id" => "graduate",
                            "icon" => "",
                            "url" => "/page/graduate-program",
                            "permission" => "",
                            "children" => []
                        ],
                        [
                            "name" => "Professional",
                            "id" => "professional",
                            "icon" => "",
                            "url" => "/page/professional-program",
                            "permission" => "",
                            "children" => []
                        ],
                        [
                            "name" => "Others",
                            "id" => "others",
                            "icon" => "",
                            "url" => "/page/other-program",
                            "permission" => "",
                            "children" => []
                        ]
                    ]
                ],
                [
                    "name" => "Admission",
                    "id" => "admission",
                    "icon" => "",
                    "url" => "",
                    "permission" => "",
                    "children" => [
                        [
                            "name" => "Undergraduate",
                            "id" => "under_graduate",
                            "icon" => "",
                            "url" => "/page/under-graduate-admission",
                            "permission" => "",
                            "children" => []
                        ],
                        [
                            "name" => "Graduate",
                            "id" => "graduate",
                            "icon" => "",
                            "url" => "/page/graduate-admission",
                            "permission" => "",
                            "children" => []
                        ]
                    ]
                ],
                [
                    "name" => "Curriculum",
                    "id" => "curriculum",
                    "icon" => "",
                    "url" => "",
                    "permission" => "",
                    "children" => [
                        [
                            "name" => "Undergraduate",
                            "id" => "undergraduate",
                            "icon" => "",
                            "url" => "/academic/curriculum/undergraduate",
                            "permission" => "",
                            "children" => []
                        ],
                        [
                            "name" => "Graduate",
                            "id" => "graduate",
                            "icon" => "",
                            "url" => "/academic/curriculum/graduate",
                            "permission" => "",
                            "children" => []
                        ]
                    ]
                ],
                [
                    "name" => "Calendar",
                    "id" => "calendar",
                    "icon" => "",
                    "url" => "/academic/calendar",
                    "permission" => "",
                    "children" => []
                ]
            ]
        ],
        [
            "name" => "People",
            "id" => "people",
            "icon" => "",
            "url" => "",
            "permission" => "",
            "children" => [
                [
                    "name" => "Faculty",
                    "id" => "faculty",
                    "icon" => "",
                    "url" => "/teachers",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Student",
                    "id" => "student",
                    "icon" => "",
                    "url" => "/students",
                    "permission" => "",
                    "children" => []
                ],
                /*[
                    "name" => "Staff",
                    "id" => "staff",
                    "icon" => "",
                    "url" => "/staffs",
                    "permission" => "",
                    "children" => []
                ]*/
            ]
        ],
        [
            "name" => "Research",
            "id" => "research",
            "icon" => "",
            "url" => "",
            "permission" => "",
            "children" => [
                [
                    "name" => "Publications",
                    "id" => "publications",
                    "icon" => "",
                    "url" => "/publications",
                    "permission" => "",
                    "children" => []
                ],
                /*[
                    "name" => "Researches",
                    "id" => "researches",
                    "icon" => "",
                    "url" => "/researches",
                    "permission" => "",
                    "children" => []
                ],*/
                [
                    "name" => "Projects",
                    "id" => "projects",
                    "icon" => "",
                    "url" => "/projects",
                    "permission" => "",
                    "children" => []
                ],
            ]
        ],
        [
            "name" => "Article",
            "id" => "article",
            "icon" => "",
            "url" => "/articles",
            "permission" => "",
            "children" => []
        ],
        [
            "name" => "Announcement",
            "id" => "announcement",
            "icon" => "",
            "url" => "",
            "permission" => "",
            "children" => [
                [
                    "name" => "News",
                    "id" => "news",
                    "icon" => "",
                    "url" => "/news",
                    "permission" => "",
                    "children" => []
                ],
                [
                    "name" => "Notice",
                    "id" => "notice",
                    "icon" => "",
                    "url" => "/notices",
                    "permission" => "",
                    "children" => []
                ],
                /*[
                    "name" => "Event",
                    "id" => "event",
                    "icon" => "",
                    "url" => "/events",
                    "permission" => "",
                    "children" => []
                ],*/
            ]
        ],
        [
            "name" => "Alumni",
            "id" => "alumni",
            "icon" => "",
            "url" => "/alumnus",
            "permission" => "",
            "children" => []
        ],
        [
            "name" => "Contact",
            "id" => "contact",
            "icon" => "",
            "url" => "/contact",
            "permission" => "",
            "children" => []
        ]
    ],
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
    "language_proficiency" => [
        "1" => "Elementary Proficiency",
        "2" => "Limited Working Proficiency",
        "3" => "Professional Working Proficiency",
        "4" => "Full Professional Proficiency",
        "5" => "Native / Bilingual Proficiency",
    ],
    "content_proficiency" => [
        "1" => "Basic Proficiency",
        "2" => "Novice/Limited Proficiency",
        "3" => "Intermediate Proficiency",
        "4" => "Advanced Proficiency",
        "5" => "Expert Proficiency",
    ],
    "course_types" => [
        "Theory" => "Theory",
        "Lab" => "Lab",
        "Non-credit" => "Non-credit"
    ],
    "credits" => [
        "1" => 0.5,
        "2" => 1.0,
        "3" => 1.5,
        "4" => 2.0,
        "5" => 2.5,
        "6" => 3.0,
        "7" => 3.5,
        "8" => 4.0,
    ],
    // media collection
    'media_collection' => [
        'slider' => [
            'image' => 'slider_image',
        ],
        'page' => [
            'image' => 'page_feature_image',
        ],
        'testimonial' => [
            'avatar' => 'testimonial_avatar',
        ],
        'quote' => [
            'avatar' => 'quote_avatar',
        ],
        'important_people' => [
            'avatar' => 'important_people_avatar',
        ],
        'content' => [
            'image' => 'content_image',
            'attachment' => 'content_attachment'
        ],
        'research' => [
            'image' => 'research_image',
            'attachment' => 'research_attachment'
        ],
        'project' => [
            'image' => 'project_image',
            'attachment' => 'project_attachment'
        ],
        'user' => [
            'avatar' => 'user_avatar',
        ],
        'user_personal_info' => [
            'image' => 'user_personal_info_image'
        ],
        'setting_site' => [
            'logo' => 'setting_site_logo',
            'favicon' => 'setting_site_favicon',
            'banner_image' => 'setting_site_banner_image',
            'breadcrumb_image' => 'setting_site_breadcrumb_image',
            'parallax_image_1' => 'setting_site_parallax_image_1',
            'parallax_image_2' => 'setting_site_parallax_image_2',
            'parallax_image_3' => 'setting_site_parallax_image_3',
            'footer_image' => 'setting_site_footer_image'
        ],
        'article' => [
            'image' => 'article_image'
        ]
    ],
    'image' => [
        'theme1' => [
            'default' => [
                'logo' => '/front/theme1/images/default/logo.png',
                'mbstu_logo' => '/front/theme1/images/default/mbstu-logo.png',
                'favicon' => '/front/theme1/images/default/favicon.png',
                'avatar_male' => '/front/theme1/images/default/avatar-male.jpeg',
                'avatar_female' => '/front/theme1/images/default/avatar-female.png',
                'preview_image' => '/front/theme1/images/default/preview.png',
                'banner_image' => '/front/theme1/images/default/banner.png',
                'breadcrumb_image' => '/front/theme1/images/default/breadcrumb.jpg',
                'parallax_image_1' => '/front/theme1/images/default/parallax-1.jpg',
                'parallax_image_2' => '/front/theme1/images/default/parallax-2.jpg',
                'parallax_image_3' => '/front/theme1/images/default/parallax-3.jpg',
                'footer_image' => '/front/theme1/images/default/footer.jpg',
                'slider_image' => '/front/theme1/images/default/slider.jpg'
            ]
        ],
        'theme2' => [
            'default' => [
                'logo' => '/front/theme2/images/default/logo.png',
                'mbstu_logo' => '/front/theme2/images/default/mbstu-logo.png',
                'favicon' => '/front/theme2/images/default/favicon.png',
                'avatar_male' => '/front/theme2/images/default/avatar-male.jpeg',
                'avatar_female' => '/front/theme2/images/default/avatar-female.png',
                'preview_image' => '/front/theme2/images/default/preview.png',
                'banner_image' => '/front/theme2/images/default/banner.png',
                'breadcrumb_image' => '/front/theme2/images/default/breadcrumb.jpg',
                'parallax_image_1' => '/front/theme2/images/default/parallax-1.jpg',
                'parallax_image_2' => '/front/theme2/images/default/parallax-2.jpg',
                'parallax_image_3' => '/front/theme2/images/default/parallax-3.jpg',
                'footer_image' => '/front/theme2/images/default/footer.jpg',
                'slider_image' => '/front/theme2/images/default/slider.jpg'
            ]
        ],
        'theme3' => [
            'default' => [
                'logo' => '/front/theme3/images/default/logo.png',
                'mbstu_logo' => '/front/theme3/images/default/mbstu-logo.png',
                'favicon' => '/front/theme3/images/default/favicon.png',
                'avatar_male' => '/front/theme3/images/default/avatar-male.jpeg',
                'avatar_female' => '/front/theme3/images/default/avatar-female.png',
                'preview_image' => '/front/theme3/images/default/preview.png',
                'banner_image' => '/front/theme3/images/default/banner.png',
                'breadcrumb_image' => '/front/theme3/images/default/breadcrumb.jpg',
                'parallax_image_1' => '/front/theme3/images/default/parallax-1.jpg',
                'parallax_image_2' => '/front/theme3/images/default/parallax-2.jpg',
                'parallax_image_3' => '/front/theme3/images/default/parallax-3.jpg',
                'footer_image' => '/front/theme3/images/default/footer.jpg',
                'slider_image' => '/front/theme3/images/default/slider.jpg'
            ]
        ]
    ]
];
