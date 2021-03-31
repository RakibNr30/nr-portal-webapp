<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ProjectRepository;
use Modules\Ums\Entities\User;
use Modules\Ums\Repositories\ClientRequestRepository;
use Modules\Ums\Repositories\UserRepository;

class DashboardService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * @var $userRepository
     */
    protected $projectRepository;

    /**
     * @var $userRepository
     */
    protected $clientRequestRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @param ClientRequestRepository $clientRequestRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
        ClientRequestRepository $clientRequestRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
        $this->clientRequestRepository = $clientRequestRepository;
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function adminWidget()
    {
        $data = new \stdClass();

        $data->totalCompany = $this->userRepository->model
            ->whereHas("roles", function ($query) {
            $query->where("name", "company");
        })->count();

        $data->totalPendingClient = $this->clientRequestRepository->model->count();

        $data->totalApprovedClient = $this->userRepository->model
            ->whereHas("roles", function ($query) {
                $query->where("name", "client");
            })
            ->whereNotNull('approved_at')
            ->count();

        $data->totalPendingProject = $this->projectRepository->model
            ->where([
                ['status', 0]
            ])
            ->count();

        $data->totalInProgressProject = $this->projectRepository->model
            ->where([
                ['status', 1]
            ])
            ->count();

        $data->totalAcceptedProject = $this->projectRepository->model
            ->where([
                ['status', 2]
            ])
            ->count();

        return $data;
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function clientWidget()
    {
        $data = new \stdClass();

        $data->totalPendingProject = $this->projectRepository->model
            ->where([
                ['status', 0],
                ['author_id', auth()->user()->id]
            ])
            ->count();

        $data->totalInProgressProject = $this->projectRepository->model
            ->where([
                ['status', 1],
                ['author_id', auth()->user()->id]
            ])
            ->count();

        $data->totalAcceptedProject = $this->projectRepository->model
            ->where([
                ['status', 2],
                ['author_id', auth()->user()->id]
            ])
            ->count();

        return $data;
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function companyWidget()
    {
        $data = new \stdClass();

        $data->totalAssignedProject = $this->projectRepository->model
            ->where('status', 1)
            ->whereJsonContains('company_id', auth()->user()->id)
            ->count();

        $data->totalInProgressProject = $this->projectRepository->model
            ->where('status', 2)
            ->whereJsonContains('company_id', auth()->user()->id)
            ->count();

        return $data;
    }
}
