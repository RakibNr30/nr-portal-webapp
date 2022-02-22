@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
    $currentCompany = \Illuminate\Support\Facades\Session::get('currentCompany') ?? 0;
@endphp
@section('title')
    Show |
    @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
        {{ config('core.project_paginate.approved.' . $user->getRoleNames()[0]) }}
    @else
        {{ config('core.project_paginate.approved.' . $user->getRoleNames()[0] . '_dt') }}
    @endif
    | Project
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/approved_project/show.project') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/approved_project/show.project') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-approved.index') }}">
                                    @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                        {{ config('core.project_paginate.approved.' . $user->getRoleNames()[0]) }}
                                    @else
                                        {{ config('core.project_paginate.approved.' . $user->getRoleNames()[0] . '_dt') }}
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('admin/approved_project/show.show') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if(\App\Helpers\AuthManager::isClient())
                        <div class="col-lg-12">
                            @php
                                $led = 'led-red';
                                $counter = count($project->getMedia('project_attachment_company_1')) + count($project->getMedia('project_attachment_company_2')) + count($project->getMedia('project_attachment_company_3'));
                                if ($counter == 0) $led = 'led-red';
                                if ($counter == 1 || $counter == 2) $led = 'led-yellow';
                                if ($counter == 3) $led = 'led-green';
                            @endphp

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">
                                        {{ __('admin/approved_project/show.project_id') }} #{{ $project->project_id ?? 'N/A' }}
                                    </h5>
                                    @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                                        <div class="{{ $led }}"></div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-0">
                                        {{ $project->title ?? 'N/A' }}
                                    </h5>
                                    <p class="card-tex mt-1">
                                        {!! $project->description !!}
                                    </p>

                                    @if(count($project->getMedia('client_project_image')))
                                        <h4 class="card-title">{{ __('admin/approved_project/show.project_images') }}</h4>
                                        <div class="popup-gallery">
                                            @foreach($project->getMedia('client_project_image') as $image)
                                                <a class="float-left" href="{{ $image->getUrl() }}" title="{{ $image->file_name }}">
                                                    <div class="img-fluid" style="margin-right: 3px">
                                                        <img src="{{ $image->getUrl() }}" alt="" height="130">
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-8">
                            @php
                                $led = 'led-red';
                                $counter = count($project->getMedia('project_attachment_company_1')) + count($project->getMedia('project_attachment_company_2')) + count($project->getMedia('project_attachment_company_3'));
                                if ($counter == 0) $led = 'led-red';
                                if ($counter == 1 || $counter == 2) $led = 'led-yellow';
                                if ($counter == 3) $led = 'led-green';
                            @endphp

                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">
                                        {{ __('admin/approved_project/show.project_id') }} #{{ $project->project_id ?? 'N/A' }}
                                    </h5>
                                    @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                                        <div class="{{ $led }}"></div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-0">
                                        {{ $project->title ?? 'N/A' }}
                                    </h5>
                                    <p class="card-tex mt-1">
                                        {!! $project->description !!}
                                    </p>

                                    @if(count($project->getMedia('client_project_image')))
                                        <h4 class="card-title">{{ __('admin/approved_project/show.project_images') }}</h4>
                                        <div class="popup-gallery">
                                            @foreach($project->getMedia('client_project_image') as $image)
                                                <a class="float-left" href="{{ $image->getUrl() }}" title="{{ $image->file_name }}">
                                                    <div class="img-fluid" style="margin-right: 3px">
                                                        <img src="{{ $image->getUrl() }}" alt="" height="130">
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="profile-widgets">
                                        <div class="text-center">
                                            <span class="badge badge-success mb-3">{{ __('admin/pending_project/show.project_client') }}</span>
                                            <br>
                                            <div class="">
                                                <img src="{{ $author->avatar->file_url ?? config('core.image.default.avatar') }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                            </div>

                                            <div class="mt-3">
                                                <a href="javascript:void(0)" class="text-dark font-weight-medium font-size-16">
                                                    {{ $author->basicInfo->first_name ?? '' }} {{ $author->basicInfo->last_name ?? '' }}
                                                </a>
                                                <p class="text-body mt-1 mb-1">
                                                    {{ $author->basicInfo->designation ?? '' }}
                                                </p>
                                                <a href="{{ route('backend.ums.client-approved.show', [$author->id]) }}" class="badge badge-danger p-1 mt-2">
                                                    {{ __('admin/pending_project/show.view_profile') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border border-primary">
                                <div class="card-header bg-primary">
                                    <h6 class="text-center text-white mb-0">
                                        {{ __('admin/pending_project/show.contact_info') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="profile-widgets">
                                        <div class="text-center">
                                            <div class="mt-3">
                                                @if(isset($author->basicInfo->personal_email))
                                                    <div class="mt-2">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.email_address') }}</p>
                                                        <h6 class="">
                                                            <a href="mailto: {{ $author->basicInfo->personal_email }}" style="color: unset">
                                                                {{ $author->basicInfo->personal_email }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                @endif

                                                @if(isset($author->basicInfo->phone_no))
                                                    <div class="mt-3">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.phone_number') }}</p>
                                                        <h6 class="">
                                                            <a href="tel: {{ $author->basicInfo->phone_no }}" style="color: unset">
                                                                {{ $author->basicInfo->phone_no }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                @endif
                                                @if(isset($author->residentialInfo->present_address_line_1))
                                                    <div class="mt-3">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.address') }}</p>
                                                        <h6 class="">
                                                            {{ $author->residentialInfo->present_address_line_1 }}
                                                        </h6>
                                                    </div>
                                                @endif
                                                @if(isset($author->residentialInfo->present_city))
                                                    <div class="mt-3">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.city_district') }}</p>
                                                        <h6 class="">
                                                            {{ $author->residentialInfo->present_city }}
                                                        </h6>
                                                    </div>
                                                @endif
                                                @if(isset($author->residentialInfo->present_state))
                                                    <div class="mt-3">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.state_division') }}</p>
                                                        <h6 class="">
                                                            {{ $author->residentialInfo->present_state }}
                                                        </h6>
                                                    </div>
                                                @endif
                                                @if(isset($author->residentialInfo->present_country))
                                                    <div class="mt-3">
                                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.country') }}</p>
                                                        <h6 class="">
                                                            {{ $author->residentialInfo->present_country }}
                                                        </h6>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @include('admin.partials._alert')

                @if($user->hasRole('company'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            @foreach($companies as $index => $company)
                                                <div class="faq-box media">
                                                    @if($company->id == $user->id)
                                                        <div class="col-md-12">
                                                            <div class="card-body bg-transparent text-primary">
                                                                <div>
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                    @php
                                                                        $attachment_admin = 'attachment_admin_' . ($index + 1);
                                                                        $attachment_company = 'attachment_company_' . ($index + 1);
                                                                    @endphp

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card border">
                                                                                <div class="card-header">
                                                                                    <h6 class="my-0 text-black-50 text-center">
                                                                                        {{ __('admin/approved_project/show.your_attachment') }}
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-center">
                                                                                    @if(isset($project->$attachment_company))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                {{ __('admin/approved_project/show.file_name') }}: {{ $project->$attachment_company->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                                    {{ __('admin/approved_project/show.download') }}
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">{{ __('admin/approved_project/show.no_attachment_found') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {!! Form::open(['url' => route('backend.cms.project-approved.filesUpdate', [$project->id]), 'class' => '', 'method' => 'put', 'files' => true]) !!}
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="file_company_id" value="{{ $project->company_id[$index] }}">
                                                                            <label for="attachment_company_{{ $index + 1 }}" class="@error('attachment_company_{{ $index + 1 }}') text-danger @enderror">{{ __('admin/approved_project/show.attachment') }}</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input form-control @error('attachment_company_{{ $index + 1 }}') is-invalid @enderror"
                                                                                       id="attachment_company_{{ $index + 1 }}"
                                                                                       name="attachment_company_{{ $index + 1 }}"
                                                                                       value="{{ old("attachment_company_{ $index + 1 }") }}" autofocus required>
                                                                                <label class="custom-file-label" for="customFile">{{ __('admin/approved_project/show.choose_file') }}</label>
                                                                            </div>

                                                                            @error('attachment_company_{{ $index + 1 }}')
                                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center mt-4 mb-4">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light p-1 pl-2 pr-2">{{ __('admin/approved_project/show.upload_attachment') }}</button>
                                                                    </div>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach($companies as $index => $company)
                                            <a class="nav-link {{ $currentCompany == $company->id ? 'active' : '' }} {{ !$currentCompany && !$index ? 'active' : '' }} mt-0 mb-3" data-toggle="pill" href="#v-pills-{{ $index }}" role="tab" aria-controls="v-pills-{{ $index }}" aria-selected="true">
                                                <p class="font-weight-bold mb-0 text-center">
                                                    @if(app()->getLocale() == 'en')
                                                        Company
                                                    @else
                                                        Bedrijf
                                                    @endif
                                                    #{{ $index + 1 }}
                                                </p>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                @foreach($companies as $index => $company)
                                                    <div class="tab-pane {{ $currentCompany == $company->id ? 'active show' : '' }} {{ !$currentCompany && !$index ? 'active show' : '' }} fade" id="v-pills-{{ $index }}" role="tabpanel" aria-labelledby="v-pills-{{ $index }}">
                                                        <h4 class="card-title text-center">
                                                            <a href="{{ route('backend.ums.company.show', [$company->id]) }}">
                                                                {{ $company->basicInfo->first_name }}
                                                            </a>
                                                        </h4>
                                                        <hr>
                                                        <div class="faq-box media">
                                                            <div class="card-body bg-transparent text-primary">
                                                                <div>
                                                                    @php
                                                                        $attachment_admin = 'attachment_admin_' . ($index + 1);
                                                                        $attachment_company = 'attachment_company_' . ($index + 1);
                                                                    @endphp

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="card border mb-0">
                                                                                <div class="card-header">
                                                                                    <h6 class="my-0 text-black-50 text-center">
                                                                                        {{ __('admin/approved_project/show.attachment_from_company') }}
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-primary text-center">
                                                                                    @if(isset($project->$attachment_company))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                {{ __('admin/approved_project/show.file_name') }}: {{ $project->$attachment_company->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                                    {{ __('admin/approved_project/show.download') }}
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">{{ __('admin/approved_project/show.no_attachment_found') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mb-4">
                                                                            <div class="card border">
                                                                                <div class="card-header">
                                                                                    <h6 class="my-0 text-black-50 text-center">
                                                                                        {{ __('admin/approved_project/show.attachment_from_admin') }}
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-primary text-center">
                                                                                    @if(isset($project->$attachment_admin))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                {{ __('admin/approved_project/show.file_name') }}: {{ $project->$attachment_admin->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                                    {{ __('admin/approved_project/show.download') }}
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">{{ __('admin/approved_project/show.no_attachment_found') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {!! Form::open(['url' => route('backend.cms.project-approved.filesUpdate', [$project->id]), 'class' => '', 'method' => 'put', 'files' => true]) !!}
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="file_company_id" value="{{ $project->company_id[$index] }}">
                                                                        <div class="form-group">
                                                                            {{--<label for="attachment_admin_{{ $index + 1 }}" class="@error('attachment_admin_{{ $index + 1 }}') text-danger @enderror">Attachment</label>--}}
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input form-control @error('attachment_admin_{{ $index + 1 }}') is-invalid @enderror"
                                                                                       id="attachment_admin_{{ $index + 1 }}"
                                                                                       name="attachment_admin_{{ $index + 1 }}"
                                                                                       value="{{ old("attachment_admin_{ $index + 1 }") }}" autofocus required>
                                                                                <label class="custom-file-label" for="customFile">{{ __('admin/approved_project/show.choose_file') }}</label>
                                                                            </div>
                                                                            @error('attachment_admin_{{ $index + 1 }}')
                                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center mt-4 mb-4">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light p-1 pl-2 pr-2">{{ __('admin/approved_project/show.upload_attachment') }}</button>
                                                                    </div>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if($user->hasRole('client'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach($companies as $index => $company)
                                            <a class="nav-link {{ $currentCompany == $company->id ? 'active' : '' }} {{ !$currentCompany && !$index ? 'active' : '' }} mt-0 mb-3" data-toggle="pill" href="#v-pills-{{ $index }}" role="tab" aria-controls="v-pills-{{ $index }}" aria-selected="true">
                                                <p class="font-weight-bold mb-0 text-center">
                                                    @if(app()->getLocale() == 'en')
                                                        Company
                                                    @else
                                                        Bedrijf
                                                    @endif
                                                    #{{ $index + 1 }}
                                                </p>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                @foreach($companies as $index => $company)
                                                    <div class="tab-pane {{ $currentCompany == $company->id ? 'active show' : '' }} {{ !$currentCompany && !$index ? 'active show' : '' }} fade" id="v-pills-{{ $index }}" role="tabpanel" aria-labelledby="v-pills-{{ $index }}">
                                                        <h4 class="card-title text-center">
                                                            <a href="{{ route('backend.ums.company.show', [$company->id]) }}">
                                                                {{ $company->basicInfo->first_name }}
                                                            </a>
                                                        </h4>
                                                        <hr>
                                                        <div class="faq-box media">
                                                            <div class="card-body bg-transparent text-primary">
                                                                <div>
                                                                    @php
                                                                        $attachment_admin = 'attachment_admin_' . ($index + 1);
                                                                    @endphp

                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card border mb-0">
                                                                                <div class="card-header">
                                                                                    <h6 class="my-0 text-black-50 text-center">
                                                                                        {{ __('admin/approved_project/show.project_attachment') }}
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-info text-center">
                                                                                    @if(isset($project->$attachment_admin))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                {{ __('admin/approved_project/show.choose_file') }}: {{ $project->$attachment_admin->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                                    {{ __('admin/approved_project/show.download') }}
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">{{ __('admin/approved_project/show.no_attachment_found') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $contact = DB::table('user_basic_infos')->where('user_id', $company->basicinfo->user_id)->get();
                                                                    ?>
                                                                    <project-message :contact="{{ collect($contact) }}"></project-message>

                                                                    @if(isset($project->$attachment_admin))
                                                                        {!! Form::open(['url' => route('backend.cms.project-approved.approveByClient', [$project->id]), 'class' => '', 'method' => 'put']) !!}
                                                                        <input type="hidden" name="selected_company_id[]" value="{{ $company->id }}">
                                                                        <input type="hidden" name="selected_index" value="{{ $index }}">
                                                                        <div class="text-center mt-2">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light p-1 pl-2 pr-2" onclick="return confirm('Are you sure to accept this offer?')">{{ __('admin/approved_project/show.approve_this_company') }}</button>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                        @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@stop
@section('style')
    <link href="{{ asset('common/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <style>
        .col-md-6 {
            padding-right: 6px;
            padding-left: 6px;
        }
        .popup-gallery a:last-child {
            float: none !important;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('common/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/lightbox.init.js') }}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop
