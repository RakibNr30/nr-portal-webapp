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
        'selected_company_id',
        'client_approve_status',
        'selected_index',
        'status',
    ];

    protected $hidden = [];

    protected $appends = [
        'image',
        'attachment',
        'attachment_company_1',
        'attachment_company_2',
        'attachment_company_3',
        'attachment_admin_1',
        'attachment_admin_2',
        'attachment_admin_3',
    ];

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
        'selected_company_id' => 'array',
        'status' => 'integer',
        'client_approve_status' => 'integer',
        'selected_index' => 'integer',
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

    public function getAttachmentCompany1Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_company_1'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentCompany2Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_company_2'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentCompany3Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_company_3'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentAdmin1Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_admin_1'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentAdmin2Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_admin_2'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getAttachmentAdmin3Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.project.attachment_admin_3'));
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

        // check for attachment
        if (request()->hasFile('attachment_company_1')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_company_1'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_company_1'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_company_1')
                ->toMediaCollection(config('core.media_collection.project.attachment_company_1'));
        }

        // check for attachment
        if (request()->hasFile('attachment_company_2')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_company_2'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_company_2'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_company_2')
                ->toMediaCollection(config('core.media_collection.project.attachment_company_2'));
        }

        // check for attachment
        if (request()->hasFile('attachment_company_3')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_company_3'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_company_3'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_company_3')
                ->toMediaCollection(config('core.media_collection.project.attachment_company_3'));
        }

        // check for attachment
        if (request()->hasFile('attachment_admin_1')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_admin_1'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_admin_1'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_admin_1')
                ->toMediaCollection(config('core.media_collection.project.attachment_admin_1'));
        }

        // check for attachment
        if (request()->hasFile('attachment_admin_2')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_admin_2'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_admin_2'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_admin_2')
                ->toMediaCollection(config('core.media_collection.project.attachment_admin_2'));
        }

        // check for attachment
        if (request()->hasFile('attachment_admin_3')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.project.attachment_admin_3'))) {
                $this->clearMediaCollection(config('core.media_collection.project.attachment_admin_3'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('attachment_admin_3')
                ->toMediaCollection(config('core.media_collection.project.attachment_admin_3'));
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
