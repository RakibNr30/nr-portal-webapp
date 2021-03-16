<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Project extends BaseModel implements HasMedia
{
    use Sluggable, HasMediaTrait;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'project_id',
        'slug',
        'description',
        'author_id',
        'approved_by',
        'approved_at',
        'deadline',
        'company_id',
        'status',
    ];

    protected $hidden = [];

    protected $appends = ['image', 'attachment'];

    protected $casts = [
        'title' => 'string',
        'project_id' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'author_id' => 'integer',
        'approved_by' => 'integer',
        'approved_at' => 'date',
        'deadline' => 'date',
        'company_id' => 'array',
        'status' => 'integer',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.image'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment'));
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
            if ($this->hasMedia(config('core.media_collection.project.image'))) {
                $this->clearMediaCollection(config('core.media_collection.project.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('image')
                ->toMediaCollection(config('core.media_collection.project.image'));
        }

        // check for attachment
        if (request()->hasFile('attachment')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment')
                ->toMediaCollection(config('core.media_collection.project.attachment'));
        }
    }

    private $format = 'H:i:s, d-M-Y';

    public function getDeadlineAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getApprovedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }
}
