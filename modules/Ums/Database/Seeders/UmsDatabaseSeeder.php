<?php

namespace Modules\Ums\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Cms\Entities\Publication;
use Modules\Ums\Entities\ClientRequest;
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
        //$this->seedUserProfiles();

        // seed users
        $this->seedClientRequests();

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
        // get data from json
        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/ums/users.json')), true);

        // process data
        foreach ($data as $datum) {

            // create users
            $user = User::create([
                "phone" => $datum["phone"],
                "email" => $datum["email"],
                "password" => bcrypt($datum["password"]),
                "email_verified_at" => Carbon::now(),
                "approved_at" => Carbon::now(),
                "approved_by" => 1,
                "role" => $datum['roles'][0],
            ]);

            // assign role
            $user->assignRole($datum['roles']);

            $user->basicInfo()->create([
                "first_name" => $datum["basic_info"]["first_name"],
                "last_name" => $datum["basic_info"]["last_name"],
                "about" => $datum["basic_info"]["about"],
                "designation" => $datum["basic_info"]["designation"],
                "personal_email" => $datum["basic_info"]["personal_email"],
                "mobile_no" => $datum["basic_info"]["mobile_no"],
                "blood_group" => $datum["basic_info"]["blood_group"],
                "gender" => $datum["basic_info"]["gender"],
                "user_id" => $user->id,
            ]);

            $user->residentialInfo()->create([]);
        }
    }

    private function seedUserProfiles()
    {
        $users = User::all();
        foreach ($users as $user) {
            factory(\Modules\Ums\Entities\UserBasicInfo::class, 1)->create([
                'user_id' => $user->id
            ]);
            factory(\Modules\Ums\Entities\UserResidentialInfo::class, 1)->create([
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

    private function seedClientRequests()
    {
        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/ums/client-request.json')), true);
        foreach ($data as $datum) {
            ClientRequest::create($datum);
        }
    }
}
