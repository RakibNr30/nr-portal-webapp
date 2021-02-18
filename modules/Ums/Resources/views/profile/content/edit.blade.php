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
                            <h3 class="card-title mt-1">Edit {{ $contentCategoryTitle }}</h3>
                            <a href="{{ route('backend.ums.profile-content.index', ['category' => $userContent->content_category_id]) }}" type="button" class="btn btn-success btn-sm text-white float-right">View {{ $contentCategoryTitle }} List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-content.update', [$userContent->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="content_category_id" value="{{ $userContent->content_category_id }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ old('name') ?: $userContent->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description') ?: $userContent->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                @if(in_array($userContent->content_category_id, $proficiencyContentCategories))
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="proficiency" class="d-block @error('proficiency') text-danger @enderror">Proficiency</label>
                                            <select id="proficiency" name="proficiency" class="form-control  @error('proficiency') is-invalid @enderror">
                                                <option value="">Select Proficiency</option>
                                                @foreach(config('core.content_proficiency') as $content_proficiency_key => $content_proficiency)
                                                    <option
                                                            value="{{ $content_proficiency_key }}" {{ $content_proficiency_key == $userContent->proficiency ? 'selected' : '' }}>{{ $content_proficiency }}</option>
                                                @endforeach
                                            </select>
                                            @error('proficiency')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.ums.profile-content.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
