@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Edit ImportantPerson</h3>
                            <a href="{{ route('backend.cms.important-person.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View ImportantPerson List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.important-person.update', [$importantPerson->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                            <input id="name" name="name" value="{{ old('name') ?: $importantPerson->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                            <input id="designation" name="designation" value="{{ old('designation') ?: $importantPerson->designation }}" type="text" class="form-control @error('designation') is-invalid @enderror" placeholder="Enter designation" autofocus>
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company" class="@error('company') text-danger @enderror">Company</label>
                                            <input id="company" name="company" value="{{ old('company') ?: $importantPerson->company }}" type="text" class="form-control @error('company') is-invalid @enderror" placeholder="Enter company" autofocus>
                                            @error('company')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                            <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select Avatar" autofocus>
                                            {{--@if(isset($importantPerson->avatar->file_name))
                                                <span class="invalid-feedback text-dark" role="alert"><strong>Image: {{ $importantPerson->avatar->file_name }}</strong></span>
                                            @endif--}}
                                            @if(isset($importantPerson->avatar))
                                                <div class="image-output">
                                                    <img src="{{ $importantPerson->avatar->file_url }}">
                                                </div>
                                            @endif
                                            @error('avatar')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description') ?: $importantPerson->description }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="external_link" class="@error('external_link') text-danger @enderror">ExternalLink</label>
                                            <input id="external_link" name="external_link" value="{{ old('external_link') ?: $importantPerson->external_link }}" type="text" class="form-control @error('external_link') is-invalid @enderror" placeholder="Enter external_link" autofocus>
                                            @error('external_link')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.cms.important-person.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
