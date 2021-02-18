<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ContentRepository;
use PhpParser\Node\Stmt\Return_;

class ContentService
{
    /**
     * @var $contentRepository
     */
    protected $contentRepository;

    /**
     * Constructor
     *
     * @param ContentRepository $contentRepository
     */
    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->contentRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->contentRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->contentRepository->find($id);
    }

    /**
     * Update data
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->contentRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->contentRepository->delete($id);
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function allNews($limit = 0)
    {
        return $this->contentRepository->model->where('content_category_id', 1)->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function allNotice($limit = 0)
    {
        return $this->contentRepository->model->where('content_category_id', 2)->paginate($limit);
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        $content = $this->contentRepository->findBy($attribute, $value);
        if ($content) {
            $previous = $this->contentRepository->model
                ->where([
                    ['content_category_id', $content->content_category_id],
                    ['id', '<', $content->id]
                ])->orderBy('id', 'desc')->first();

            $next = $this->contentRepository->model
                ->where([
                    ['content_category_id', $content->content_category_id],
                    ['id', '>', $content->id]
                ])->orderBy('id', 'asc')->first();

            if ($previous) {
                $content['previous_slug'] = $previous->slug;
            }

            if ($next) {
                $content['next_slug'] = $next->slug;
            }
        }

        return $content;
    }
}
