<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\DataTables\AllProjectDataTable;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;

class AllProjectController extends Controller
{
    /**
     * @var $projectService
     */
    protected $projectService;

    /**
     * Constructor
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->middleware(['permission:my_projects']);
    }

    /**
     * Project list
     *
     * @param AllProjectDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(AllProjectDataTable $datatable)
    {
        return $datatable->render('cms::project.all.index');
    }
}