<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserPersonalInfoRepository;

class UserPersonalInfoService
{
    /**
     * @var $userPersonalInfoRepository
     */
    protected $userPersonalInfoRepository;

    /**
     * Constructor
     *
     * @param UserPersonalInfoRepository $userPersonalInfoRepository
     */
    public function __construct(UserPersonalInfoRepository $userPersonalInfoRepository)
    {
        $this->userPersonalInfoRepository = $userPersonalInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userPersonalInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userPersonalInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userPersonalInfoRepository->find($id);
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
        return $this->userPersonalInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userPersonalInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userPersonalInfoRepository->model->firstOrCreate($data);
    }

    /**
     * Find author by author_id
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findAuthor($attribute, $value)
    {
        return $this->userPersonalInfoRepository->findBy($attribute, $value);
    }

    /**
     * Update or create personal info
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function updateOrCreate($attribute, $value)
    {
        return $this->userPersonalInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
