@extends('layouts.app')

@section('content')
<style>
    body, p {
        color:midnightblue;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.verify_header') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.verify_sent') }}
                        </div>
                    @endif

                    {{ __('auth.verify_checkemail') }}
                    {{ __('auth.verify_not_receive') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.verify_click_here') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
