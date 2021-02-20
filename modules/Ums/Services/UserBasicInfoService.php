<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserBasicInfoRepository;

class UserBasicInfoService
{
    /**
     * @var $userBasicInfoRepository
     */
    protected $userBasicInfoRepository;

    /**
     * Constructor
     *
     * @param UserBasicInfoRepository $userBasicInfoRepository
     */
    public function __construct(UserBasicInfoRepository $userBasicInfoRepository)
    {
        $this->userBasicInfoRepository = $userBasicInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userBasicInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userBasicInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userBasicInfoRepository->find($id);
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
        return $this->userBasicInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userBasicInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userBasicInfoRepository->model->firstOrCreate($data);
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
        return $this->userBasicInfoRepository->findBy($attribute, $value);
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
        return $this->userBasicInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
