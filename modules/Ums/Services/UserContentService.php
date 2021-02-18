<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserContentRepository;

class UserContentService
{
    /**
     * @var $userContentRepository
     */
    protected $userContentRepository;

    /**
     * Constructor
     *
     * @param UserContentRepository $userContentRepository
     */
    public function __construct(UserContentRepository $userContentRepository)
    {
        $this->userContentRepository = $userContentRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userContentRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userContentRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userContentRepository->find($id);
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
        return $this->userContentRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userContentRepository->delete($id);
    }
}
