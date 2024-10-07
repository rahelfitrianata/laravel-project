@extends('layouts.app')

@section('content')
<div class="halamanlogin">
        <div class="col-md-8">
            <div class="card-login">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-left">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-left">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="btn-login">
                            <div class="col-md-8 offset-md-4">
                                <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                <button type="submit" class="btn btn-primary" style="width: 30%;">
                                    {{ __('Login') }}
                                </button>
                                <br>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" style= "width: 50%; margin-left: -37px;" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <br>
                                <span style="width: 30%; display: inline-block; text-align: center;">Or login with</span>   
                                <br>
                                <div style="display: flex; justify-content: center; margin-top: 10px; margin-left: -280px; margin-right: 20px;">
                                <a href="{{ route('social.login', ['provider' => 'google']) }}">
                                    <img src="{{ asset('lte/assets/img/google.png') }}" style="width:30px;">
                                </a>
                                <a href="https://t.me/mrIndoBot?start=login">
                                    <img src="{{ asset('lte/assets/img/telegram.png') }}" style="width:33px; margin-left: 7px;">
                                </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
