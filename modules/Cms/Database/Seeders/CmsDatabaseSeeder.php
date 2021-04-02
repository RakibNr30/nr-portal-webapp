<?php

namespace Modules\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Cms\Entities\MailContent;

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

        $data = json_decode(File::get(resource_path('seed/' . config('core.theme') . '/cms/mail-content.json')), true);
        foreach ($data as $datum) {
            MailContent::create($datum);
        }
    }
}
