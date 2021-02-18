<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Article extends BaseModel implements HasMedia
{
    use Sluggable, HasMediaTrait;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
		'description',
		'feature_image',
		'approve_status',
		'approved_at',
		'approved_by',
		'article_category_id',
		'author_id',
    ];

    protected $hidden = [
        'approved_by',
    ];

    protected $appends = ['image'];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
		'description' => 'string',
		'feature_image' => 'string',
		'approve_status' => 'boolean',
		'approved_at' => 'timestamp',
		'approved_by' => 'string',
		'article_category_id' => 'integer',
		'author_id' => 'integer',
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
        $media = $this->getMedia(config('core.media_collection.article.image'));
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
            if ($this->hasMedia(config('core.media_collection.article.image'))) {
                $this->clearMediaCollection(config('core.media_collection.article.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('image')
                ->toMediaCollection(config('core.media_collection.article.image'));
        }
    }
}
