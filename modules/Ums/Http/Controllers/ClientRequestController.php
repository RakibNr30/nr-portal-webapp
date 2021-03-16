<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;

// datatable...
use Modules\Ums\Datatables\ClientRequestDataTable;

// services...
use Modules\Ums\Http\Requests\ClientRequestStoreRequest;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Services\ClientRequestBasicInfoService;
use Modules\Ums\Services\ClientRequestService;
use Modules\Ums\Services\UserBasicInfoService;

use function GuzzleHttp\Promise\all;
use Modules\Ums\Services\UserResidentialInfoService;
use Modules\Ums\Services\UserService;

class ClientRequestController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $clientRequestService
     */
    protected $clientRequestService;

    /**
     * @var $basicInfoService
     */
    protected $userBasicInfoService;

    /**
     * @var $basicInfoService
     */
    protected $userResidentialInfoService;

    /**
     * Constructor
     *
     * @param ClientRequestService $clientRequestService
     * @param UserBasicInfoService $userBasicInfoService
     * @param UserService $userService
     * @param UserResidentialInfoService $userResidentialInfoService
     */
    public function __construct(
        ClientRequestService $clientRequestService,
        UserBasicInfoService $userBasicInfoService,
        UserService $userService,
        UserResidentialInfoService $userResidentialInfoService
    )
    {
        $this->userService = $userService;
        $this->clientRequestService = $clientRequestService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->userResidentialInfoService = $userResidentialInfoService;
        $this->middleware(['permission:user_controls']);
    }

    /**
     * ClientRequest list
     *
     * @param ClientRequestDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ClientRequestDatatable $datatable)
    {
        return $datatable->render('ums::client.request.index');
    }

    /**
     * Store clientRequest
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClientRequestStoreRequest $request)
    {
        // get data
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        $roles = $data['roles'];
        // insert role to user table
        $data['role'] = $roles[0];
        // create user
        $user = $this->userService->create($data);
        // assign roles
        $user->assignRole($roles);
        // check if client Request created
        if ($user) {
            $data['user_id'] = $user->id;
            $data['first_name'] = $data['full_name'];
            $data['about'] = $data['description'];
            $data['personal_email'] = $user->email;
            $data['phone_no'] = $user->phone;
            $data['present_street_name'] = $data['street_name'];
            $data['present_house_number'] = $data['house_number'];
            $data['present_zip_code'] = $data['zip_code'];
            $data['present_city'] = $data['city'];
            $basicInfo = $this->userBasicInfoService->create($data);
            $residentialInfo = $this->userResidentialInfoService->create($data);
            if ($basicInfo && $residentialInfo) {
                // flash notification
                notifier()->success('Client approved successfully.');
                // delete request client
                $this->clientRequestService->delete($data['client_id']);
                // redirect to
                return redirect()->to('/backend/client/request');
            } else {
                // flash notification
                notifier()->error('Client cannot be approved successfully.');
            }
        } else {
            // flash notification
            notifier()->error('Client cannot be approved successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show clientRequest.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get clientRequest
        $clientRequest = $this->clientRequestService->find($id);

        // check if clientRequest doesn't exists
        if (empty($clientRequest)) {
            // flash notification
            notifier()->error('Client Request not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::client.request.show', compact('clientRequest'));
    }

    /**
     * Show clientRequest.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get clientRequest
        $clientRequest = $this->clientRequestService->find($id);
        // check if clientRequest doesn't exists
        if (empty($clientRequest)) {
            // flash notification
            notifier()->error('Client Request not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::client.request.edit', compact('clientRequest'));
    }

    /**
     * Delete clientRequest
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get clientRequest
        $clientRequest = $this->clientRequestService->find($id);
        // check if clientRequest doesn't exists
        if (empty($clientRequest)) {
            // flash notification
            notifier()->error('Client Request not found!');
            // redirect back
            return redirect()->back();
        }
        // delete clientRequest
        if ($this->clientRequestService->delete($id)) {
            // flash notification
            notifier()->success('Client Request deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Client Request cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
