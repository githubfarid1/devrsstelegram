@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('alert')
                    <div class="card-header">
                        <h4>{{ __('auth.login') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('auth.field_email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('auth.field_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('auth.login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('auth.forgot_password') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Alternative Login -->
                    <div class="mx-0 px-0 bg-light">
                        <div class="pt-4">
                            <div class="row justify-content-center">
                                <h5>{{ __('auth.login_with') }}</h5>
                            </div> <!-- Social Media Login buttons -->
                            <div class="row justify-content-center pt-4">
                                <div class="col-10">
                                    <div class="row justify-content-center">
                                        <!-- Facebook Connect -->
                                        <div class="col-7 col-sm-4 px-1 pb-1"> <a href="{{ route('auth.facebook') }}"
                                                class="btn btn-block btn-social btn-facebook"> <span
                                                    class="fa fa-facebook"></span> Facebook </a> </div>
                                        <!-- Google Connect -->
                                        <div class="col-7 col-sm-4 px-1 pb-1"> <a href="{{ route('auth.google') }}"
                                                class="btn btn-block btn-social btn-google"> <span
                                                    class="fa fa-google-plus"></span> Google+ </a> </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Horizontal Line -->
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
