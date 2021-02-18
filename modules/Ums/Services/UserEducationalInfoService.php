<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserEducationalInfoRepository;

class UserEducationalInfoService
{
    /**
     * @var $userEducationalInfoRepository
     */
    protected $userEducationalInfoRepository;

    /**
     * Constructor
     *
     * @param UserEducationalInfoRepository $userEducationalInfoRepository
     */
    public function __construct(UserEducationalInfoRepository $userEducationalInfoRepository)
    {
        $this->userEducationalInfoRepository = $userEducationalInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userEducationalInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userEducationalInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userEducationalInfoRepository->find($id);
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
        return $this->userEducationalInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userEducationalInfoRepository->delete($id);
    }
}
