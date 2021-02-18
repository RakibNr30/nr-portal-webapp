<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ImportantPerson extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'important_people';

    protected $fillable = [
        'name',
		'designation',
		'company',
		'description',
		'external_link',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'designation' => 'string',
		'company' => 'string',
		'description' => 'string',
		'external_link' => 'string',
    ];

    // get avatar attribute
    public function getAvatarAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.important_people.avatar'));
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
        // check for avatar
        if (request()->hasFile('avatar')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.important_people.avatar'))) {
                $this->clearMediaCollection(config('core.media_collection.important_people.avatar'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('avatar')
                ->toMediaCollection(config('core.media_collection.important_people.avatar'));
        }
    }
}
