<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\MailContentRepository;

class MailContentService
{
    /**
     * @var $mailContentRepository
     */
    protected $mailContentRepository;

    /**
     * Constructor
     *
     * @param MailContentRepository $mailContentRepository
     */
    public function __construct(MailContentRepository $mailContentRepository)
    {
        $this->mailContentRepository = $mailContentRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->mailContentRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->mailContentRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->mailContentRepository->find($id);
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
        return $this->mailContentRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->mailContentRepository->delete($id);
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        return $this->mailContentRepository->findBy($attribute, $value);
    }

    /**
     * First or create data
     *
     * @return mixed
     */
    public function first()
    {
        return $this->mailContentRepository->model->first();
    }
}
