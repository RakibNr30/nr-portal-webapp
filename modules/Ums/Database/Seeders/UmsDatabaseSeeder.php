<?php

namespace Modules\Ums\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Cms\Entities\Publication;
use Modules\Ums\Entities\Permission;
use Modules\Ums\Entities\Role;
use Modules\Ums\Entities\User;

class UmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // seed social sites
        $this->seedSocialSites();

        // seed roles
        $this->seedRoles();

        // seed permissions
        $this->seedPermissions();

        // seed users
        $this->seedUsers();

        // seed user profiles
        $this->seedUserProfiles();

        // seed teachers
        $this->seedTeachers();

        //[FACTORY_REGISTER]

    }

    private function seedRoles()
    {
        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/ums/role.json')), true);
        foreach ($data as $datum) {
            Role::create($datum);
        }
    }

    private function seedPermissions()
    {
        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/ums/permission.json')), true);
        foreach ($data as $datum) {
            $roles = $datum['roles'];
            unset($datum['roles']);
            $permission = Permission::create($datum);
            $permission->assignRole($roles);
        }
    }

    private function seedSocialSites()
    {
        $sites = [
            [
                'title' => 'facebook',
                'link' => 'https://facebook.com/:username:'
            ],
            [
                'title' => 'linkedin',
                'link' => 'https://linkedin.com/in/:username:'
            ],
            [
                'title' => 'twitter',
                'link' => 'https://twitter.com/@:username:'
            ],
            [
                'title' => 'github',
                'link' => 'https://github.com/:username:'
            ]
        ];

        foreach ($sites as $site) {
            factory(\Modules\Ums\Entities\SocialSite::class, 1)->create([
                'title' => $site['title'],
                'link' => $site['link']
            ]);
        }
    }

    private function seedUsers()
    {
        // super admin
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Super Admin']);
        });

        // seed admin
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Admin']);
        });
        /*foreach (range(1, 5) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'admin' . $item,
                'email' => 'admin' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Admin']);
            });
        }*/

        // seed editor
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'editor',
            'email' => 'editor@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Editor']);
        });
        /*foreach (range(1, 5) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'editor' . $item,
                'email' => 'editor' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Editor']);
            });
        }*/

        /*// seed teacher
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'teacher',
            'email' => 'teacher@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Teacher']);
        });
        foreach (range(1, 15) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'teacher' . $item,
                'email' => 'teacher' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Teacher']);
            });
        }

        // seed staff
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'staff',
            'email' => 'staff@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Staff']);
        });
        foreach (range(1, 20) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'staff' . $item,
                'email' => 'staff' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Staff']);
            });
        }

        // seed student
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'student',
            'email' => 'student@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Student']);
        });
        foreach (range(1, 100) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'student' . $item,
                'email' => 'student' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Student']);
            });
        }

        // seed alumni
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'alumni',
            'email' => 'alumni@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['Alumni']);
        });
        foreach (range(1, 100) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'alumni' . $item,
                'email' => 'alumni' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['Alumni']);
            });
        }

        // seed user
        $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
            'username' => 'user',
            'email' => 'user@example.com',
        ]);
        $users->each(function ($user) {
            $user->assignRole(['User']);
        });
        foreach (range(1, 100) as $item) {
            $users = factory(\Modules\Ums\Entities\User::class, 1)->create([
                'username' => 'user' . $item,
                'email' => 'user' . $item . '@example.com',
            ]);
            $users->each(function ($user) {
                $user->assignRole(['User']);
            });
        }*/
    }

    private function seedUserProfiles()
    {
        $users = User::all();
        foreach ($users as $user) {
            factory(\Modules\Ums\Entities\UserPersonalInfo::class, 1)->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserResidentialInfo::class, 1)->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserEducationalInfo::class, 3)->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserWorkInfo::class, rand(1, 5))->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserContent::class, rand(5, 10))->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserLanguage::class, 1)->create([
                'name' => 'Bengali',
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserLanguage::class, 1)->create([
                'name' => 'English',
                'user_id' => $user->id
            ]);
            if (rand(0, 1)) {
                factory(\Modules\Ums\Entities\UserLanguage::class, 1)->create([
                    'user_id' => $user->id
                ]);
            }
            factory(\Modules\Ums\Entities\UserInterest::class, rand(3, 5))->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserSocialAccount::class, 1)->create([
                'social_site_id' => 1,
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserSocialAccount::class, 1)->create([
                'social_site_id' => 2,
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserSocialAccount::class, 1)->create([
                'social_site_id' => 3,
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserSocialAccount::class, 1)->create([
                'social_site_id' => 4,
                'user_id' => $user->id
            ]);
        }
    }

    private function seedTeachers()
    {
        // get data from json
        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/ums/teachers.json')), true);

        // process data
        foreach ($data as $datum) {

            // create users
            $user = User::create([
                "username" => explode("@", $datum["email"])[0],
                "phone" => $datum["phone"],
                "email" => $datum["email"],
                "password" => bcrypt("password"),
                "email_verified_at" => Carbon::now(),
                "profile_completeness" => 10,
                "approved_at" => Carbon::now(),
                "approved_by" => 1,
            ]);

            // assign role
            $user->assignRole($datum['roles']);

            // upload image from path
            $image_path = public_path("images/teachers/{$user->username}.jpg");
            if (File::exists($image_path)) {
                // remove old file from collection
                if ($user->hasMedia(config('core.media_collection.user.avatar'))) {
                    $user->clearMediaCollection(config('core.media_collection.user.avatar'));
                }
                // upload new file to collection
                $user->addMedia($image_path)
                    ->toMediaCollection(config('core.media_collection.user.avatar'));
            }

            // create personal info
            $user->personalInfo()->create([
                "first_name" => $datum["name"],
                "first_name_bn" => $datum["name_bn"],
                "designation" => $datum["designation"],
                "personal_email" => $datum["email"],
                "mobile_no" => $datum["phone"],
                "blood_group" => $datum["blood_group"],
                "gender" => $datum["gender"],
                "user_id" => $user->id,
            ]);

            // create residential info
            $user->residentialInfo()->create([
                "present_address_line_1" => $datum["present_address"],
                "user_id" => $user->id,
            ]);

            foreach ($datum["educational_info"] as $education) {
                $user->educationalInfos()->create([
                    "start_date" => $education["start_date"],
                    "end_date" => $education["end_date"],
                    "degree_name" => $education["degree_name"],
                    "institute_name" => $education["institute_name"],
                    "user_id" => $user->id,
                ]);
            }

            // field of interests
            foreach ($datum["field_of_interest"] as $interest)
            {
                $user->interests()->create([
                    "name" => $interest,
                    "user_id" => $user->id,
                ]);
            }

            // journal papers
            foreach ($datum["journal_papers"] as $journal_papers)
            {
                Publication::create([
                    'title' => $journal_papers['title'],
                    'publisher_id' => 1,
                    'author_id' => $user->id,
                    'form_type' => 1,
                    'description' => $journal_papers['description'],
                    'external_link' => $journal_papers['external_link'],
                    'publication_category_id' => 2,
                ]);
            }
        }

        /*
        $zip_path = public_path("images/teachers.zip");
        $extract_path = public_path("images/teachers");
        Zipper::make($zip_path)->extractTo($extract_path);
        */
    }
}
