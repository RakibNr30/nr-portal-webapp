<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\ImportantPersonService;

// requests...
use Modules\Cms\Http\Requests\ImportantPersonStoreRequest;
use Modules\Cms\Http\Requests\ImportantPersonUpdateRequest;

// resources...
use Modules\Cms\Transformers\ImportantPersonResource;

class ImportantPersonController extends Controller
{
    /**
     * @var $importantPersonService
     */
    protected $importantPersonService;

    /**
     * Constructor
     *
     * @param ImportantPersonService $importantPersonService
     */
    public function __construct(ImportantPersonService $importantPersonService)
    {
        $this->importantPersonService = $importantPersonService;
    }

    /**
     * ImportantPerson list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all importantPeople
        $importantPeople = $this->importantPersonService->all(request()->get('limit') ?? 0);
        // if no importantPerson found
        if (!count($importantPeople)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('ImportantPerson not available.');
        }
        // transform importantPeople
        $importantPeople = ImportantPersonResource::collection($importantPeople);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($importantPeople);
    }

    /**
     * Store a importantPerson.
     *
     * @param ImportantPersonStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportantPersonStoreRequest $request)
    {
        // create importantPerson
        $importantPerson = $this->importantPersonService->create($request->all());
        // check if created
        if ($importantPerson) {
            // transform importantPerson
            $importantPerson = ImportantPersonResource::make($importantPerson);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('ImportantPerson created successfully.')
                ->data($importantPerson);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ImportantPerson cannot be created.');
        }
    }

    /**
     * Show importantPerson.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // if no importantPerson found
        if (empty($importantPerson)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ImportantPerson not found.');
        }
        // transform importantPerson
        $importantPerson = ImportantPersonResource::make($importantPerson);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('ImportantPerson is available.')
            ->data($importantPerson);
    }

    /**
     * Update importantPerson.
     *
     * @param ImportantPersonUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImportantPersonUpdateRequest $request, $id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // if no importantPerson found
        if (empty($importantPerson)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ImportantPerson not found.');
        }
        // update importantPerson
        $importantPerson = $this->importantPersonService->update($request->all(), $id);
        // check if updated
        if ($importantPerson) {
            // get updated importantPerson
            $importantPerson = $this->importantPersonService->find($id);
            // transform importantPerson
            $importantPerson = ImportantPersonResource::make($importantPerson);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ImportantPerson updated successfully.')
                ->data($importantPerson);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ImportantPerson cannot be updated.');
        }
    }

    /**
     * Remove importantPerson.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // if no importantPerson found
        if (empty($importantPerson)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ImportantPerson not found.');
        }
        // delete importantPerson
        if ($this->importantPersonService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ImportantPerson deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ImportantPerson cannot be deleted.');
        }
    }
}
