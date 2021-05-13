<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Modules\Ums\Http\Requests\ClientCreateStoreRequest;

// services...
use Modules\Ums\Services\UserResidentialInfoService;
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserService;

class ClientCreateController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $basicInfoService
     */
    protected $userBasicInfoService;

    /**
     * @var $roleService
     */
    protected $userResidentialInfoService;

    /**
     * Constructor
     *
     * @param UserService $userService
     * @param UserBasicInfoService $userBasicInfoService
     * @param UserResidentialInfoService $userResidentialInfoService
     */
    public function __construct(UserService $userService, UserBasicInfoService $userBasicInfoService, UserResidentialInfoService $userResidentialInfoService)
    {
        $this->userService = $userService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->userResidentialInfoService = $userResidentialInfoService;
        $this->middleware(['permission:user_controls']);
    }

    /**
     * Create user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::client.create');
    }


    /**
     * Store user
     *
     * @param ClientCreateStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClientCreateStoreRequest $request)
    {
        // get data
        $data = $request->all();

        $str_result_pass = '0123456789abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~';
        $tmp_pass = substr(str_shuffle($str_result_pass), 0, 10);
        $password = $tmp_pass;

        $mail_data = [
            'mail_category_id' => 7,
            'password' => $password,
            'email' => $data['email']
        ];
        $data['password'] = bcrypt($password);
        $data['role'] = "client";
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        // create user
        $user = $this->userService->create($data);
        // assign role
        $user->assignRole(['client']);
        // upload files
        $user->uploadFiles();
        // check if user created
        if ($user) {
            $data['personal_email'] = $user->email;
            $data['personal_phone'] = $user->phone;
            $data['user_id'] = $user->id;
            $data['personal_email'] = $user->email;
            $data['phone_no'] = $user->phone;
            $data['present_street_name'] = $data['street_name'];
            $data['present_house_number'] = $data['house_number'];
            $data['present_zip_code'] = $data['zip_code'];
            $data['present_city'] = $data['city'];
            $basicInfo = $this->userBasicInfoService->updateOrCreate(['user_id' => $user->id], $data);
            $residentialInfo = $this->userResidentialInfoService->updateOrCreate(['user_id' => $user->id], $data);
            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo && $residentialInfo) {
                $mail_data['user_id'] = $user->id;
                // flash notification
                notifier()->success(__('admin/notifier.client_created_successfully'));
                try {
                    MailManager::send($mail_data['email'], $mail_data);
                } catch (\Exception $exception) {
                    // flash notification
                    notifier()->warning(__('admin/notifier.client_created_successfully_but_email_sending_failed'));
                }
            } else {
                // flash notification
                notifier()->error(__('admin/notifier.client_cannot_be_created_successfully'));
            }
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.client_cannot_be_created_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}