@extends('layouts.no')

@section('title', 'Inscription')

@section('content')

<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url('{{asset('images/login/auth-bg.png')}}')">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                <a href="https://systemin.fr" class="mb-0 mb-lg-20">
                    <img alt="Logo" src="{{asset('assets/media/logos/default.svg')}}" class="theme-light-show h-60px" />
                    <img alt="Logo" src="{{asset('assets/media/logos/default-dark.svg')}}" class="theme-dark-show h-60px" />
                </a>
                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="{{asset('assets/media/misc/auth-screens.png')}}" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block fs-2qx fw-bold text-center mb-7">"Connectez-vous à votre espace, conçu avec tout notre savoir-faire. Parce que chaque clic est une avancée dans votre projet, et anime notre passion !"</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">
                    Systemin
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="fv-row mb-8">
                            <!--begin::Name-->
                            <input type="text" placeholder="Nom" name="name" value="{{ old('name') }}" id="floatingInput" required class="form-control bg-transparent" />
                            <!--end::Name-->
                            @if ($errors->has('name'))
                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" id="floatingInput" required class="form-control bg-transparent" />
                            <!--end::Email-->
                            @if ($errors->has('email'))
                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::Password-->
                            <input type="password" placeholder="Mot de passe" name="password" id="floatingInput" required autocomplete="new-password" class="form-control bg-transparent" />
                            <!--end::Password-->
                            @if ($errors->has('password'))
                            <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::Password Confirmation-->
                            <input type="password" placeholder="Confirmation" name="password_confirmation" id="floatingInput" required autocomplete="new-password" class="form-control bg-transparent" />
                            <!--end::Password Confirmation-->
                            @if ($errors->has('password_confirmation'))
                            <div class="text-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

                        <!-- Button -->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Register</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                    </form>

                    <!--end::Input group=-->
                    <!--begin::Sign in link-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">Déjà inscrit ?
                        <a href="{{ route('login') }}" class="link-primary">Connexion</a>
                    </div>
                    <!--end::Sign in link-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap px-5">
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base">
                    <a href="https://keenthemes.com" class="px-5" target="_blank">Terms</a>
                    <a href="https://devs.keenthemes.com" class="px-5" target="_blank">Plans</a>
                    <a href="https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/" class="px-5" target="_blank">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>

@endsection
