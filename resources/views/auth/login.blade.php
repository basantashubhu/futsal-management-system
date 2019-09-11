@extends('layouts.login')
@section('content')
<style>
.m-checkbox > span{
    border-color: #fff !important;
}
.m-checkbox > span:after{
    border-color: #fff !important;
}
p.e_stipend{
    text-align: center;
    color: #fff;
    margin: 0;
    font-size: 65px;
    padding: 0;
    font-weight: 900;
    margin-bottom: 0;
    margin-top: 8px;
    letter-spacing: -1px;
    position: relative;
}

.e_stipend span:last-child{
    position: absolute;
    top: 20px;
}

.e_stipend .minus{
    font-size: 45px;
    left: 69px;
    top: 50px;
    position: absolute;
}
.m-login.m-login--2.m-login-2--skin-3 .m-login__container .m-login__head .m-login__title{
    color: #36a3f7;
}
.m-login.m-login--2.m-login-2--skin-3 .m-login__container .m-login__head .m-login__desc {
    color: #f5f5f5;
}
</style>
    <div class="m-grid m-grid--hor m-grid--root m-page" style='background-color:#113A5D !important;' >
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3"
             id="m_login">
            <div class="m-grid__item m-grid__item--fluid    m-login__wrapper">
                <div class="m-login__logo text-center">
                    <a href="#">
                        <img alt="" src="{{'images/logo.png'}}" style="height:90px;"/>
                    </a>
                    <p class="e_stipend">FUTSAL</p>
                    <p class="text-white h4">Management System</p>
                </div> 

                <div class="m-login__container">
                    <div class="m-login__logo">
                        
                    </div> 
                    <div class="m-login__signin">
                        <div class="m-login__head">
                        </div>
                        <form id="loginForm" class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                            {{csrf_field()}}
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email or Username"
                                       name="email" autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password"
                                       placeholder="Password" name="password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox" style="color:#fff !important;">
                                        <input type="checkbox" name="remember">
                                        Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="javascript:;" id="m_login_forget_password" class="m-link" style="color:#fff !important;">
                                        Forget Password ?
                                    </a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button type="submit" id="m_login_signin_submit" class="btn btn-success btn-login m-btn m-btn--pill m-login__btn">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__signup">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Citizen Sign Up
                            </h3>

                        </div>
                        <form class="m-login__form m-form" action="" style="margin: 0px ">

                            {{csrf_field()}}
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email"
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
                                <button id="m_login_signup_submit"
                                        class="btn btn-focus m-btn m-btn--pill m-btn--custom btn-login  m-login__btn">
                                    Sign Up
                                </button>
                                &nbsp;&nbsp;
                                <button id="m_login_signup_cancel"
                                        class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom btn-login-outline-focus m-login__btn">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Forgotten Password -->
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Forgotten Password ?
                            </h3>
                            <div class="m-login__desc">
                                Enter your email to reset your password:
                            </div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email"
                                       id="m_email" autofocus="true" autocomplete="off">
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_forget_password_submit"
                                        class="btn btn-primary btn-login active m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                    Request
                                </button>
                                &nbsp;&nbsp;
                                <button id="m_login_forget_password_cancel"
                                        class="btn btn-secondary m-btn m-btn--pill m-btn--custom  m-login__btn">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__account">
                    <span class="m-login__account-msg" style="color:#fff !important;">
                    @php echo date("Y") @endphp © Futsal Management System.
                    </span>
                        &nbsp;&nbsp;
                        <!-- <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                            Sign Up
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

