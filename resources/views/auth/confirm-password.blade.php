@extends('plugincmslaravel::layouts.no')

@section('title', 'Confirmer le mot de passe')

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
    <!--begin::Authentication - Confirm Password -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url('{{ asset('images/login/auth-bg.png') }}')">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                <a href="https://systemin.fr" class="mb-0 mb-lg-20">
                    <img alt="Logo" src="{{ asset('assets/media/logos/default.svg') }}" class="theme-light-show h-60px" />
                    <img alt="Logo" src="{{ asset('assets/media/logos/default-dark.svg') }}" class="theme-dark-show h-60px" />
                </a>

                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/media/misc/auth-screens.png') }}" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block fs-2qx fw-bold text-center mb-7">"Confirmez votre mot de passe pour continuer. Chaque clic est une avancée dans votre projet, et anime notre passion !"</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">
                    LilianBellini
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
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="fv-row mb-8">
                            <!--begin::Password-->
                            <input type="password" placeholder="Mot de passe" name="password" autocomplete="off" id="password" required class="form-control bg-transparent" />
                            <!--end::Password-->
                            @if ($errors->has('password'))
                            <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_confirm_password_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Confirmer</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Veuillez patienter...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Confirm Password-->
</div>

@endsection