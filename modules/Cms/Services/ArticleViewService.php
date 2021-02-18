<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ArticleViewRepository;

class ArticleViewService
{
    /**
     * @var $articleViewRepository
     */
    protected $articleViewRepository;

    /**
     * Constructor
     *
     * @param ArticleViewRepository $articleViewRepository
     */
    public function __construct(ArticleViewRepository $articleViewRepository)
    {
        $this->articleViewRepository = $articleViewRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->articleViewRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->articleViewRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->articleViewRepository->find($id);
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
        return $this->articleViewRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->articleViewRepository->delete($id);
    }
}
