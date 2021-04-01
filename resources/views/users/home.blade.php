@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME',  'home - zikolaravelecommerce') }}</title>
<meta name="keywords" content="here you can see home page in zikolaravelecommerce" >
<link href="{{ asset('css/users/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    @if (session('resent'))
        <div class="alert alert-success text-center" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    @if (Auth::user()->email_verified_at == null)
        <div class="alert alert-warning text-center">
            please verify your email
            if you didn't recieve verification link click resend again
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" style="margin-left:5px " class="btn btn-primary">{{ __('resend again') }}</button>.
            </form> 
        </div>

        
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
