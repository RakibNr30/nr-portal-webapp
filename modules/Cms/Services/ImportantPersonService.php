<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ImportantPersonRepository;

class ImportantPersonService
{
    /**
     * @var $importantPersonRepository
     */
    protected $importantPersonRepository;

    /**
     * Constructor
     *
     * @param ImportantPersonRepository $importantPersonRepository
     */
    public function __construct(ImportantPersonRepository $importantPersonRepository)
    {
        $this->importantPersonRepository = $importantPersonRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->importantPersonRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->importantPersonRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->importantPersonRepository->find($id);
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
        return $this->importantPersonRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->importantPersonRepository->delete($id);
    }
}
