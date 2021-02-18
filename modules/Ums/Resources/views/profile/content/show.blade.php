@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 5 + $userContent->content_category_id])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ $contentCategoryTitle }} Details</h3>
                            <a href="{{ route('backend.ums.profile-content.index', ['category' => $userContent->content_category_id]) }}" type="button" class="btn btn-success btn-sm text-white float-right">View {{ $contentCategoryTitle }} List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ $userContent->name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description-" class="@error('description') text-danger @enderror">Description</label>
                                        <div>
                                            {!! $userContent->description ?: 'N/A' !!}
                                        </div>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                @if(in_array($userContent->content_category_id, $proficiencyContentCategories))
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="proficiency" class="@error('proficiency') text-danger @enderror">Proficiency</label>
                                            <br>
                                                @foreach(config('core.content_proficiency') as $content_proficiency_key => $content_proficiency)
                                                    {{ $content_proficiency_key == $userContent->proficiency ? $content_proficiency : '' }}
                                                @endforeach
                                            {{ $userContent->proficiency ? '':'N/A' }}
                                            @error('proficiency')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.profile-content.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
