@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Profile</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">My Profile</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.profile-social-account.index') }}">Social Account</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 3])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Update Social Account</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-social-account.update', [$userSocialAccount->id]), 'method' => 'put', 'files' => true]) !!}
                                <div class="form-group">
                                    <label for="social_site_id"
                                           class="@error('social_site_id') text-danger @enderror">Social Site</label>
                                    <select id="social_site_id" name="social_site_id"
                                            class="form-control @error('social_site_id') is-invalid @enderror">
                                        <option value="">Select Site</option>
                                        @foreach($socialSites as $socialSite)
                                            <option value="{{ $socialSite->id }}" {{ $userSocialAccount->social_site_id == $socialSite->id ? 'selected' : '' }}>{{ \Illuminate\Support\Str::title($socialSite->title) }}</option>
                                        @endforeach
                                    </select>
                                    @error('social_site_id')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username" class="@error('username') text-danger @enderror">Social
                                        Site Username</label>
                                    <input id="username" name="username"
                                           value="{{ old('username') ?: $userSocialAccount->username }}" type="text"
                                           class="form-control @error('username') is-invalid @enderror"
                                           placeholder="Enter social site username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="button-items float-right">
                                    <a href="{{ route('backend.ums.profile-social-account.index') }}" type="button"
                                       class="btn btn-danger waves-effect waves-light">Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
