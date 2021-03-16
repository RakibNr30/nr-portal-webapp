<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ProjectRepository;
use Modules\Ums\Entities\User;

class ProjectService
{
    /**
     * @var $projectRepository
     */
    protected $projectRepository;

    /**
     * Constructor
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->projectRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->projectRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->projectRepository->find($id);
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
        return $this->projectRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->projectRepository->delete($id);
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
        $project = $this->projectRepository->findBy($attribute, $value);
        if ($project) {
            $previous = $this->projectRepository->model
                ->where([
                    ['project_category_id', $project->project_category_id],
                    ['id', '<', $project->id]
                ])->orderBy('id', 'desc')->first();

            $next = $this->projectRepository->model
                ->where([
                    ['project_category_id', $project->project_category_id],
                    ['id', '>', $project->id]
                ])->orderBy('id', 'asc')->first();

            if ($previous) {
                $project['previous_slug'] = $previous->slug;
            }

            if ($next) {
                $project['next_slug'] = $next->slug;
            }
        }

        return $project;
    }

    /**
     * Find data
     *
     * @param $companies_id
     * @return mixed
     */
    public function companies($companies_id)
    {
        $companies = [];
        $index = 0;
        foreach ($companies_id as $company_id) {
            $user = User::find($company_id);
            if ($user) {
                $companies[$index++] = $user;
            }
        }

        return $companies;
    }

}
