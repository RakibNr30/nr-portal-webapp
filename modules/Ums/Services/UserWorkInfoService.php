<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserWorkInfoRepository;

class UserWorkInfoService
{
    /**
     * @var $userWorkInfoRepository
     */
    protected $userWorkInfoRepository;

    /**
     * Constructor
     *
     * @param UserWorkInfoRepository $userWorkInfoRepository
     */
    public function __construct(UserWorkInfoRepository $userWorkInfoRepository)
    {
        $this->userWorkInfoRepository = $userWorkInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userWorkInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userWorkInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userWorkInfoRepository->find($id);
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
        return $this->userWorkInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userWorkInfoRepository->delete($id);
    }
}
