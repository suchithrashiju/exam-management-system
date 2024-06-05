@extends('layouts.home_layout')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="auth-form">
                        <h4 class="text-center mb-4">Student Login</h4>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('student.login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                    <a href="{{ route('home') }}" class="btn btn-dark">Cancel</a>

                                </div>
                                <div class="flex items-center justify-end mt-4 row">
                                    <p class="card-text mt-2">Don't have an account? <a
                                            href="{{ route('student.register') }}">Create
                                            one</a>


                                    </p>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
