@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 11])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Edit User Social Account</h3>
                            <a href="{{ route('backend.ums.profile-social-account.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View User Social Account List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-social-account.update', [$userSocialAccount->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                </div>
                                <div class="col-md-12">
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
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.ums.profile-social-account.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
