@extends('layouts.home_layout')
@section('content')
    <div class="col-md-12">
        <h2>Student Registration Form</h2>
        <p class="mb-4">
            Welcome to the online assessment registration portal. Please fill out the form below to register for
            upcoming assessments. Ensure that all details are accurate and complete to facilitate a smooth
            registration process.
        </p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6>Please fill all mandatory fields</h6>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('student.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">Mobile <span class="text-danger">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control"
                                    value="{{ old('mobile') }}">
                                @error('mobile')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                    value="">
                                @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="adress" class="form-control" rows="3"> {{ old('address') }}</textarea>
                                @error('adress')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="{{ route('home') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
