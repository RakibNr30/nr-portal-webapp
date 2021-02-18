<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserContentStoreRequest;
use Modules\Ums\Http\Requests\UserContentUpdateRequest;

// datatable...
use Modules\Ums\Datatables\Profile\ContentDataTable;

// services...
use Modules\Ums\Services\UserContentService;

class ContentController extends Controller
{
    /**
     * @var $userContentService
     */
    protected $userContentService;
    protected $contentCategories;
    //
    protected $proficiencyContentCategories;

    /**
     * Constructor
     *
     * @param UserContentService $userContentService
     */
    public function __construct(UserContentService $userContentService)
    {
        $this->userContentService = $userContentService;
        $this->contentCategories = [0, 1, 2, 3, 4, 5];
        $this->proficiencyContentCategories = [5];
    }

    /**
     * UserContent list
     *
     * @param ContentDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ContentDataTable $datatable)
    {
        if (!request()->has('category') || !in_array(request()->get('category'), $this->contentCategories)) {
            return redirect()->route('backend.ums.profile-content.index', ['category' => 1]);
        }
        $contentCategoryId = request()->get('category');
        $contentCategoryTitle = $this->getUserContentTitle($contentCategoryId);

        return $datatable->render('ums::profile.content.index',
            compact('contentCategoryId', 'contentCategoryTitle'));
    }

    /**
     * Create userContent
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!request()->has('category') || !in_array(request()->get('category'), $this->contentCategories)) {
            return redirect()->route('backend.ums.profile-content.create', ['category' => 1]);
        }
        $contentCategoryId = request()->get('category');
        $contentCategoryTitle = $this->getUserContentTitle($contentCategoryId);
        $proficiencyContentCategories = $this->proficiencyContentCategories;

        // return view
        return view('ums::profile.content.create',
            compact( 'contentCategoryId', 'contentCategoryTitle', 'proficiencyContentCategories'));
    }


    /**
     * Store userContent
     *
     * @param UserContentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserContentStoreRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userContent
        $userContent = $this->userContentService->create($data);
        // check if userContent created
        if ($userContent) {
            // flash notification
            notifier()->success('User Content created successfully.');
        } else {
            // flash notification
            notifier()->error('User Content cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userContent.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userContent
        $userContent = $this->userContentService->find($id);
        // check if userContent doesn't exists
        if (empty($userContent)) {
            // flash notification
            notifier()->error('User Content not found!');
            // redirect back
            return redirect()->back();
        }

        $proficiencyContentCategories = $this->proficiencyContentCategories;
        $contentCategoryTitle = $this->getUserContentTitle($userContent->content_category_id);

        // return view
        return view('ums::profile.content.show',
            compact('userContent' ,'contentCategoryTitle', 'proficiencyContentCategories'));
    }

    /**
     * Show userContent.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get userContent
        $userContent = $this->userContentService->find($id);
        // check if userContent doesn't exists
        if (empty($userContent)) {
            // flash notification
            notifier()->error('User Content not found!');
            // redirect back
            return redirect()->back();
        }

        $proficiencyContentCategories = $this->proficiencyContentCategories;
        $contentCategoryTitle = $this->getUserContentTitle($userContent->content_category_id);

        // return view
        return view('ums::profile.content.edit',
            compact('userContent', 'contentCategoryTitle', 'proficiencyContentCategories'));
    }

    /**
     * Update userContent
     *
     * @param UserContentUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserContentUpdateRequest $request, $id)
    {
        // get userContent
        $userContent = $this->userContentService->find($id);
        // check if userContent doesn't exists
        if (empty($userContent)) {
            // flash notification
            notifier()->error('User Content not found!');
            // redirect back
            return redirect()->back();
        }
        // request data
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // update userContent
        $userContent = $this->userContentService->update($data, $id);
        // check if userContent updated
        if ($userContent) {
            // flash notification
            notifier()->success('User Content updated successfully.');
        } else {
            // flash notification
            notifier()->error('User Content cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userContent
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userContent
        $userContent = $this->userContentService->find($id);
        // check if userContent doesn't exists
        if (empty($userContent)) {
            // flash notification
            notifier()->error('User Content not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userContent
        if ($this->userContentService->delete($id)) {
            // flash notification
            notifier()->success('User Content deleted successfully.');
        } else {
            // flash notification
            notifier()->success('User Content cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    private function getUserContentTitle($categoryId)
    {
        switch ($categoryId) {
            case 1:
                $title = 'Honors & Awards';
                break;
            case 2:
                $title = 'Areas Of Expertise';
                break;
            case 3:
                $title = 'Areas Of Teaching';
                break;
            case 4:
                $title = 'Ongoing Courses';
                break;
            case 5:
                $title = 'Skills';
                break;
            case 0:
            default:
                $title = 'Others';
                break;
        }
        return $title;
    }
}
