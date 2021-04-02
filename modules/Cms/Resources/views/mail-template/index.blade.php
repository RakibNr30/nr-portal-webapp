@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Mail Template</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mail Template</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials._alert')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Mail Template</h4>
                        <form action="/backend/mail-template" method="get">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="mail_category">Mail Template Category</label>
                                    <select id="mail_category" name="mail_category" class="form-control" required>
                                        @foreach(config('core.mail_category') as $key => $mailCategory)
                                            <option value="{{ $key }}" {{ $key == $mailContent->mail_category_id ? 'selected' : '' }}>
                                                {{ $mailCategory }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['url' => route('backend.cms.mail-template.update', [$mailContent->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <input type="hidden" name="content_category_id" value="{{ $mailContent->mail_category_id }}">
                            <div class="form-group col-md-12">
                                <label for="subject" class="@error('subject') text-danger @enderror">Subject</label>
                                <input id="subject" name="subject" value="{{ old('subject') ?: $mailContent->subject }}"
                                       type="text"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       placeholder="Enter company name" autofocus required>
                                @error('subject')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="body"
                                       class="@error('body') text-danger @enderror">Mail Body</label>
                                <textarea id="body" name="body" rows="5"
                                          class="form-control summernote @error('body') is-invalid @enderror"
                                          placeholder="Enter company body" autofocus required>{{ old('body') ?: $mailContent->body }}</textarea>
                                @error('body')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="button-items float-right">
                                    <a href="{{ route('backend.cms.mail-template.index') }}" type="button"
                                       class="btn btn-danger waves-effect waves-light">Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#mail_category').on('change', function () {
            this.form.submit();
        });
    </script>
@stop