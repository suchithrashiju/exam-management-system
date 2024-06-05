@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Add Exam Detail</h1>
        <div class="text-right">
            <a href="{{ route('exams.index') }}" class="btn btn-primary mr-5">List</a>
        </div>
        <div class="error-message-sec">
            <div id="error-message" class=" text-center text-danger mt-1 mb-1"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Exam Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Duration <span class="text-danger">*</span></label>
                            <span class="">(Enter duration in minutes)</span>
                            <input type="number" class="form-control" id="duration" name="duration" required
                                value="{{ old('duration') }}">
                            @error('duration')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Total Mark <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="total_mark" name="total_mark" required
                                value="{{ old('total_mark') }}">
                            @error('total_mark')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Pass Mark <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="pass_mark" name="pass_mark" required
                                value="{{ old('pass_mark') }}">
                            @error('pass_mark')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_published" name="is_published"
                                    {{ old('is_published') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Is Published</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_archived" name="is_archived"
                                    {{ old('is_archived') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_archived">Is Archived</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <div id="hidden-form-fields"></div>
                            <button type="submit" class="btn btn-primary" id="submit-form">Save</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
