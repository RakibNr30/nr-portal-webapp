<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserInterestRepository;

class UserInterestService
{
    /**
     * @var $userInterestRepository
     */
    protected $userInterestRepository;

    /**
     * Constructor
     *
     * @param UserInterestRepository $userInterestRepository
     */
    public function __construct(UserInterestRepository $userInterestRepository)
    {
        $this->userInterestRepository = $userInterestRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userInterestRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userInterestRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userInterestRepository->find($id);
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
        return $this->userInterestRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userInterestRepository->delete($id);
    }
}
