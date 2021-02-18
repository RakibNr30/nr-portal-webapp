<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Quote extends BaseModel implements hasMedia
{
    use hasMediaTrait;

    protected $table = 'quotes';

    protected $fillable = [
        'name',
		'designation',
		'message',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'designation' => 'string',
		'message' => 'string',
    ];

    // get avatar attribute
    public function getAvatarAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.quote.avatar'));
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
            if ($this->hasMedia(config('core.media_collection.quote.avatar'))) {
                $this->clearMediaCollection(config('core.media_collection.quote.avatar'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('avatar')
                ->toMediaCollection(config('core.media_collection.quote.avatar'));
        }
    }
}
