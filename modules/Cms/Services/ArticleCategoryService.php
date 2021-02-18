<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ArticleCategoryRepository;

class ArticleCategoryService
{
    /**
     * @var $articleCategoryRepository
     */
    protected $articleCategoryRepository;

    /**
     * Constructor
     *
     * @param ArticleCategoryRepository $articleCategoryRepository
     */
    public function __construct(ArticleCategoryRepository $articleCategoryRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->articleCategoryRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->articleCategoryRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->articleCategoryRepository->find($id);
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
        return $this->articleCategoryRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->articleCategoryRepository->delete($id);
    }
}
