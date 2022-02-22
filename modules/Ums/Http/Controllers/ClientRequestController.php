<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use App\Notification;
use Carbon\Carbon;

// datatable...
use Illuminate\Support\Facades\Auth;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\DataTables\ClientRequestDataTable;

// services...
use Modules\Ums\Entities\UserBasicInfo;
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
     * @var $basicInfoService
     */
    protected $projectService;

    /**
     * Constructor
     *
     * @param ClientRequestService $clientRequestService
     * @param UserBasicInfoService $userBasicInfoService
     * @param UserService $userService
     * @param UserResidentialInfoService $userResidentialInfoService
     * @param ProjectService $projectService
     */
    public function __construct(
        ClientRequestService $clientRequestService,
        UserBasicInfoService $userBasicInfoService,
        UserService $userService,
        UserResidentialInfoService $userResidentialInfoService,
        ProjectService $projectService
    )
    {
        $this->userService = $userService;
        $this->clientRequestService = $clientRequestService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->userResidentialInfoService = $userResidentialInfoService;
        $this->projectService = $projectService;
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

        $str_result_pass = '0123456789abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~';
        $tmp_pass = substr(str_shuffle($str_result_pass), 0, 10);
        $password = $tmp_pass;

        $mail_data = [
            'mail_category_id' => 1,
            'password' => $password,
            'email' => $data['email']
        ];

        $data['password'] = bcrypt($password);
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        $roles = $data['roles'];
        // insert role to user table
        $data['role'] = $roles[0];
        // create user
        $user = $this->userService->create($data);
        $mail_data['user_id'] = $user->id;
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

            $data['title'] = $data['project_title'];
            $data['description'] = $data['project_description'];
            $data['author_id'] = $user->id;

            $basicInfo = $this->userBasicInfoService->create($data);
            $residentialInfo = $this->userResidentialInfoService->create($data);
            $project = $this->projectService->create($data);
            if ($basicInfo && $residentialInfo && $project) {
                // GENERATE AN UNIQUE KEY FOR A PROJECT

                /*$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';*/
                $str_result = '1234';
                $tmp_id = substr(str_shuffle($str_result), 0, 4);
                $project_id = $tmp_id . $project->id;

                $mail_data['project_id'] = $project->id;
                $data = [
                    'project_id' => $project_id,
                    'client_id' => $data['client_id'],
                ];

                $this->projectService->update($data, $project->id);

                // Notification for Admin
                Notification::create([
                    'project_id' => $project_id,
                    'type' => 'ProjectCreation',
                    'notification_from' => $user->id,
                    'notification_to_type' => 'admin',
                    'notification_from_type' => 'client',
                    'message' => 'Client: ' . UserBasicInfo::where('user_id', $user->id)->first()->first_name . ' een project heeft aangevraagd. Beoordeel het.',
                    'status' => 'unseen',
                ]);

                // Notification for Client
                Notification::create([
                    'project_id' => $project_id,
                    'type' => 'ClientApproval',
                    'notification_from' => auth()->user()->id,
                    'notification_to' => $user->id,
                    'notification_to_type' => 'client',
                    'notification_from_type' => 'admin',
                    'message' => 'Uw aanvraag is goedgekeurd en Project #'.$project_id.'. gemaakt. Controleer het.',
                    'status' => 'unseen',
                ]);

                // flash notification
                notifier()->success(__('admin/notifier.client_approved_successfully'));
                try {
                    MailManager::send($mail_data['email'], $mail_data);
                } catch (\Exception $exception) {
                    // flash notification
                    notifier()->warning(__('admin/notifier.client_approved_successfully_but_email_sending_failed'));
                }

                // delete request client
                $this->clientRequestService->delete($data['client_id']);
                // redirect to
                return redirect()->to('/backend/client/request');
            } else {
                // flash notification
                notifier()->error(__('admin/notifier.client_cannot_be_approved_successfully'));
            }
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.client_cannot_be_approved_successfully'));
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
            notifier()->error(__('admin/notifier.client_request_not_found'));
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
            notifier()->error(__('admin/notifier.client_request_not_found'));
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
            notifier()->error(__('admin/notifier.client_request_not_found'));
            // redirect back
            return redirect()->back();
        }
        // delete clientRequest
        if ($this->clientRequestService->delete($id)) {
            // flash notification
            notifier()->success(__('admin/notifier.client_request_deleted_successfully'));
        } else {
            // flash notification
            notifier()->success(__('admin/notifier.client_request_cannot_be_deleted_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}
