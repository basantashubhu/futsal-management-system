@extends('layouts.login')

@section('content')
    <div class="m-grid m-grid--hor m-grid--root m-page" style="background-color: #d5d5d5;">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3"
             id="m_login">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img alt="" src="/{{ config('site.logo.sm') }}"/>
                        </a>
                    </div>
                    <div id="CreateCredential" style="display: block">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Citizen Sign Up
                            </h3>

                        </div>
                        <form class="m-login__form m-form" action="" style="margin: 0px ">

                            {{csrf_field()}}
                            <input type="hidden" name="email_token" value="{{$token}}">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email"
                                       name="personal_email" value="{{$email}}"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Name" name="name"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password"
                                       placeholder="SSN (Last 4 Digits only)"
                                       name="ssn"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password" placeholder="Password"
                                       name="password"
                                       autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="password" placeholder="Retype password"
                                       name="password_confirmation"
                                       autocomplete="off">
                            </div>
                            <div class="row form-group m-form__group m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--light">
                                        <input type="checkbox" name="agree">
                                        I Agree the
                                        <a href="#" class="m-link m-link--focus">
                                            terms and conditions
                                        </a>
                                        .
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_client_signup_submit"
                                        class="btn btn-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                                    Sign Up
                                </button>
                                &nbsp;&nbsp;
                                <button id="m_login_signup_cancel"
                                        class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="RegistrationSuccesfullSection" style="display: none">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Registration Sucessfully
                            </h3>

                        </div>
                        Congratulation!! You are registered Successfully
                    </div>

                    <div class="m-login__account">
					<span class="m-login__account-msg">
					@php echo date("Y") @endphp © ZEUSLOGIC
					</span>
                        &nbsp;&nbsp;
                        <a href="/login4" class="m-link m-link--light m-login__account-link">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

