<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserSocialAccountRepository;

class UserSocialAccountService
{
    /**
     * @var $userSocialAccountRepository
     */
    protected $userSocialAccountRepository;

    /**
     * Constructor
     *
     * @param UserSocialAccountRepository $userSocialAccountRepository
     */
    public function __construct(UserSocialAccountRepository $userSocialAccountRepository)
    {
        $this->userSocialAccountRepository = $userSocialAccountRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userSocialAccountRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userSocialAccountRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userSocialAccountRepository->find($id);
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
        return $this->userSocialAccountRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userSocialAccountRepository->delete($id);
    }
}
