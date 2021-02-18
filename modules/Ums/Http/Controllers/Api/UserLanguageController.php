<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserLanguageService;

// requests...
use Modules\Ums\Http\Requests\UserLanguageStoreRequest;
use Modules\Ums\Http\Requests\UserLanguageUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserLanguageResource;

class UserLanguageController extends Controller
{
    /**
     * @var $userLanguageService
     */
    protected $userLanguageService;

    /**
     * Constructor
     *
     * @param UserLanguageService $userLanguageService
     */
    public function __construct(UserLanguageService $userLanguageService)
    {
        $this->userLanguageService = $userLanguageService;
    }

    /**
     * UserLanguage list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userLanguages
        $userLanguages = $this->userLanguageService->all(request()->get('limit') ?? 0);
        // if no userLanguage found
        if (!count($userLanguages)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserLanguage not available.');
        }
        // transform userLanguages
        $userLanguages = UserLanguageResource::collection($userLanguages);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userLanguages);
    }

    /**
     * Store a userLanguage.
     *
     * @param UserLanguageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserLanguageStoreRequest $request)
    {
        // create userLanguage
        $userLanguage = $this->userLanguageService->create($request->all());
        // check if created
        if ($userLanguage) {
            // transform userLanguage
            $userLanguage = UserLanguageResource::make($userLanguage);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserLanguage created successfully.')
                ->data($userLanguage);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserLanguage cannot be created.');
        }
    }

    /**
     * Show userLanguage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // if no userLanguage found
        if (empty($userLanguage)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserLanguage not found.');
        }
        // transform userLanguage
        $userLanguage = UserLanguageResource::make($userLanguage);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserLanguage is available.')
            ->data($userLanguage);
    }

    /**
     * Update userLanguage.
     *
     * @param UserLanguageUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserLanguageUpdateRequest $request, $id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // if no userLanguage found
        if (empty($userLanguage)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserLanguage not found.');
        }
        // update userLanguage
        $userLanguage = $this->userLanguageService->update($request->all(), $id);
        // check if updated
        if ($userLanguage) {
            // get updated userLanguage
            $userLanguage = $this->userLanguageService->find($id);
            // transform userLanguage
            $userLanguage = UserLanguageResource::make($userLanguage);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserLanguage updated successfully.')
                ->data($userLanguage);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserLanguage cannot be updated.');
        }
    }

    /**
     * Remove userLanguage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // if no userLanguage found
        if (empty($userLanguage)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserLanguage not found.');
        }
        // delete userLanguage
        if ($this->userLanguageService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserLanguage deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserLanguage cannot be deleted.');
        }
    }
}
