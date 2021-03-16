<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserResidentialInfoRepository;

class UserResidentialInfoService
{
    /**
     * @var $userResidentialInfoRepository
     */
    protected $userResidentialInfoRepository;

    /**
     * Constructor
     *
     * @param UserResidentialInfoRepository $userResidentialInfoRepository
     */
    public function __construct(UserResidentialInfoRepository $userResidentialInfoRepository)
    {
        $this->userResidentialInfoRepository = $userResidentialInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userResidentialInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userResidentialInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userResidentialInfoRepository->find($id);
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
        return $this->userResidentialInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userResidentialInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userResidentialInfoRepository->model->firstOrCreate($data);
    }

    /**
     * First or create data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function updateOrCreate($attribute, $value)
    {
        return $this->userResidentialInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
