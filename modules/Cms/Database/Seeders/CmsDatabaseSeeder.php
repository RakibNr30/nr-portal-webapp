<?php

namespace Modules\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Cms\Entities\Content;
use Modules\Cms\Entities\ContentCategory;
use Modules\Cms\Entities\Course;
use Modules\Cms\Entities\Department;
use Modules\Cms\Entities\Faculty;
use Modules\Cms\Entities\Faq;
use Modules\Cms\Entities\ImportantPerson;
use Modules\Cms\Entities\Page;
use Modules\Cms\Entities\PageCategory;
use Modules\Cms\Entities\Program;
use Modules\Cms\Entities\PublicationCategory;
use Modules\Cms\Entities\Publisher;
use Modules\Cms\Entities\Quote;
use Modules\Cms\Entities\Semester;
use Modules\Cms\Entities\Slider;
use Modules\Cms\Entities\Testimonial;

class CmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // seed hall
        /*
        factory(\Modules\Cms\Entities\Hall::class, 5)->create();
        // seed faculty
        factory(\Modules\Cms\Entities\Faculty::class, 5)->create()->each(function ($faculty) {
            // seed departments
            factory(\Modules\Cms\Entities\Department::class, rand(3, 7))->create([
                'faculty_id' => $faculty->id
            ])->each(function ($department) {
                // entry programs
                factory(\Modules\Cms\Entities\Program::class, rand(2, 3))->create([
                    'department_id' => $department->id
                ])->each(function ($program) {
                    // entry semesters
                    factory(\Modules\Cms\Entities\Semester::class, rand(2, 8))->create([
                        'program_id' => $program->id
                    ])->each(function ($semester) {
                        // entry programs
                        factory(\Modules\Cms\Entities\Course::class, 10)->create([
                            'program_id' => $semester->program_id,
                            'semester_id' => $semester->id,
                        ]);
                    });
                });
                // Entry session
                for ($i = 2003; $i < 2021; $i++) {
                    factory(\Modules\Cms\Entities\Session::class, 10)->create([
                        'session_year' => $i . '-' . ($i + 1),
                        'full_session_year' => $i . '-' . ($i + 1),
                        'short_session_year' => $i . '-' . ($i + 1),
                        'batch_name' => $i - 2000,
                        'department_id' => $department->id,
                    ]);
                }
            });
        });*/
        // seed slider
        //factory(\Modules\Cms\Entities\Slider::class, 10)->create();
        // seed menu
        /*factory(\Modules\Cms\Entities\Menu::class, 3)->create()->each(function ($menu) {
            factory(\Modules\Cms\Entities\MenuLink::class, 10)->create();
        });*/
        // seed page category
        /*factory(\Modules\Cms\Entities\PageCategory::class, 10)->create()->each(function ($pageCategory) {
            factory(\Modules\Cms\Entities\Page::class, 10)->create([
                'page_category_id' => $pageCategory->id
            ]);
        });*/
        // seed contents
        /*factory(\Modules\Cms\Entities\ContentCategory::class, 10)->create()->each(function ($contentCategory) {
            factory(\Modules\Cms\Entities\Content::class, 10)->create([
                'content_category_id' => $contentCategory->id
            ]);
        });*/
        // seed academic calendar
        /*factory(\Modules\Cms\Entities\AcademicCalendarCategory::class, 10)->create()->each(function ($academicCalendarCategory) {
            factory(\Modules\Cms\Entities\AcademicCalendar::class, 10)->create([
                'academic_calender_id' => $academicCalendarCategory->id
            ]);
        });*/
        /*
        // seed research Category
        factory(\Modules\Cms\Entities\ResearchCategory::class, 10)->create()->each(function ($researchCategory) {
            factory(\Modules\Cms\Entities\Research::class, 10)->create();
        });
        // seed project ype
        factory(\Modules\Cms\Entities\ProjectCategory::class, 10)->create()->each(function ($projectCategory) {
            factory(\Modules\Cms\Entities\Project::class, 10)->create();
        });
        // seed article Category
        factory(\Modules\Cms\Entities\ArticleCategory::class, 10)->create()->each(function ($articleCategory) {
            factory(\Modules\Cms\Entities\Article::class, 10)->create([
                'article_category_id' => $articleCategory->id
            ]);
        });*/
        /*factory(\Modules\Cms\Entities\ClassSchedule::class, 10)->create();
        factory(\Modules\Cms\Entities\ResearchFile::class, 10)->create();
        factory(\Modules\Cms\Entities\ResearchMember::class, 10)->create();
        factory(\Modules\Cms\Entities\ResearchScreenShot::class, 10)->create();
        factory(\Modules\Cms\Entities\ProjectFile::class, 10)->create();
        factory(\Modules\Cms\Entities\ProjectMember::class, 10)->create();
        factory(\Modules\Cms\Entities\ProjectScreenShot::class, 10)->create();
        factory(\Modules\Cms\Entities\ArticleView::class, 10)->create();*/
        //factory(\Modules\Cms\Entities\Faq::class, 10)->create();
        //factory(\Modules\Cms\Entities\Quote::class, 10)->create();
        //factory(\Modules\Cms\Entities\Testimonial::class, 10)->create();
        //factory(\Modules\Cms\Entities\Publisher::class, 10)->create();
        //factory(\Modules\Cms\Entities\PublicationCategory::class, 10)->create();
        //factory(\Modules\Cms\Entities\Publication::class, 10)->create();
        //factory(\Modules\Cms\Entities\ImportantPerson::class, 10)->create();
        //[FACTORY_REGISTER]

        // cms data
    }
}
