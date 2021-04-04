@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">All Notifications ({{ $notifications_count }})</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('backend/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notifications</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="timeline-count p-4">
                            <!-- Timeline row Start -->
                            <div class="row">

                                <!-- Timeline 1 -->
                                <div class="timeline-box col-lg-12">

                                    @if($notifications_count > 0)
                                        @foreach($notifications as $item => $notification)
                                        <?php
                                            $date_time = strtotime($item);
                                            $not_date = date('d M Y', $date_time);
                                        ?>

                                        <div class="timeline-spacing">
                                            <div class="item-lable bg-primary rounded">
                                                <p class="text-center text-white">{{ $not_date }}</p>
                                            </div>
                                            <div class="timeline-line active">
                                                <div class="dot bg-primary"></div>
                                            </div>
                                            <div class="vertical-line">
                                                <div class="wrapper-line bg-light"></div>
                                            </div>
                                            @foreach($notification as $notify)

                                            <?php
                                                $DateTime = $notify['created_at'];
                                                $newDateTime = date('h:i A', strtotime($DateTime));
                                            ?>

                                            <?php
                                                $user_avatar = App\User::where('id', $notify['notification_from'])->first();
                                                if (isset($notify->project_id)) {
                                                    $project_id = \Modules\Cms\Entities\Project::where('project_id', $notify->project_id)->first()->id;
                                                    if ($notify->type == "ProjectCreation") $url = '/backend/project/pending/' . $project_id;
                                                    else if ($notify->type == "ProjectApproval") $url = '/backend/project/approved/' . $project_id;
                                                    else if ($notify->type == "ProjectClientApproval") $url = '/backend/project/accepted/' . $project_id;
                                                    else if ($notify->type == "ProjectCompanyFile") $url = '/backend/project/approved/' . $project_id;
                                                    else if ($notify->type == "ProjectAdminFile") $url = '/backend/project/approved/' . $project_id;
                                                }
                                            ?>

                                            <div class="bg-light p-4 rounded mx-3" style="margin-bottom: -30px !important;">
                                                <div class="img-wrapper" style="display: flex;flex-direction: column;align-items: center;gap: 8px;">
                                                    <img src="{{ $user_avatar->avatar->file_url ?? config('core.image.default.avatar') }}" class="mr-3 rounded-circle avatar-xs" alt="user-pic">

                                                    <a href="{{ $url }}"><h6 class="not-message">{{ $notify['message'] }}</h6></a>
                                                    <p class="text-muted mt-1 mb-0" style="margin-top: -15px !important;font-weight: 450;"><i class="mdi mdi-clock-outline"></i> {{ $newDateTime }} - {{ $DateTime->diffForHumans() }}</p>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger text-center" role="alert">
                                            <i class="mdi mdi-bullseye-arrow mr-2"></i> No notification found !

                                        </div>
                                    @endif
                                </div>
                                <!-- Timeline 1 -->


                            </div>


                            <!-- Timeline row Over -->
                        </div>

                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->

    </div>
@stop