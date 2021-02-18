<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ContentCategoryRepository;

class ContentCategoryService
{
    /**
     * @var $contentCategoryRepository
     */
    protected $contentCategoryRepository;

    /**
     * Constructor
     *
     * @param ContentCategoryRepository $contentCategoryRepository
     */
    public function __construct(ContentCategoryRepository $contentCategoryRepository)
    {
        $this->contentCategoryRepository = $contentCategoryRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->contentCategoryRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->contentCategoryRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->contentCategoryRepository->find($id);
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
        return $this->contentCategoryRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->contentCategoryRepository->delete($id);
    }
}
