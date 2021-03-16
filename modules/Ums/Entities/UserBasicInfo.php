<?php

namespace Modules\Ums\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class UserBasicInfo extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'user_basic_infos';

    protected $fillable = [
        'first_name',
		'last_name',
		'first_name_bn',
		'last_name_bn',
        'designation',
        'company_name',
        'about',
		'phone_no',
		'mobile_no',
		'fax_no',
		'personal_email',
		'professional_email',
		'website_url',
		'dob',
		'blood_group',
		'gender',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $appends = ['image'];

    protected $casts = [
        'first_name' => 'string',
		'last_name' => 'string',
		'designation' => 'string',
		'company_name' => 'string',
		'about' => 'string',
		'phone_no' => 'string',
		'mobile_no' => 'string',
		'fax_no' => 'string',
		'personal_email' => 'string',
		'professional_email' => 'string',
		'website_url' => 'string',
		'dob' => 'timestamp',
		'blood_group' => 'string',
		'gender' => 'string',
		'user_id' => 'integer',
    ];

    public function getImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user_basic_info.image'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function uploadFiles()
    {
        // check for image
        if (request()->hasFile('image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user_basic_info.image'))) {
                $this->clearMediaCollection(config('core.media_collection.user_basic_info.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('image')
                ->toMediaCollection(config('core.media_collection.user_basic_info.image'));
        }
    }
}
