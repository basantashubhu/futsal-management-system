@extends('layouts.login')

@section('content')
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login">
        <div class="m-grid__item m-grid__item--fluid    m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img alt="" src="{{ config('site.logo.sm') }}"/>
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            {{ __('Reset Password') }}
                        </h3>
                    </div>
                    @php if($errors->count()): @endphp
                    <div>&nbsp;</div>
                    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <span>{{ $errors->first() }}</span>
                    </div>
                    @php endif; @endphp
                    <form class="m-login__form m-form" method="POST" action="{{ route('password.request') }}">
                        {{csrf_field()}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="off" value="{{ $email or old('email') }}">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" name="password">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
                        </div>
                        <div class="m-login__form-action">
                            <button class="btn btn-success m-btn m-btn--pill m-login__btn" type="submit">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="m-login__account">
                    <span class="m-login__account-msg">
                        2019 © ZEUSLOGIC
                    </span>
                    <!-- &nbsp;&nbsp;
                    <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                        Sign Up
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
