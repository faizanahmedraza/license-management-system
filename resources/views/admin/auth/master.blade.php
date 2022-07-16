@extends('admin.base.base')

@once
@push('styles')
@section('styles')
    <style></style>
@show
@endpush
@endonce

@section('body')
    <body data-kt-name="metronic" id="kt_body"
          class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Theme mode setup on page load-->
    <script>if (document.documentElement) {
            const defaultThemeMode = "system";
            const name = document.body.getAttribute("data-kt-name");
            let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
            if (themeMode === null) {
                if (defaultThemeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }</script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>body {
                background-image: url('{{asset('assets/media/auth/bg4.jpg')}}');
            }

            [data-theme="dark"] body {
                background-image: url('{{asset('assets/media/auth/bg4-dark.jpg')}}');
            }</style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-column">
                    <!--begin::Logo-->
                    <a href="" class="mb-7">
                        <img alt="Logo" src="{{asset('assets/media/logos/custom-3.svg')}}"/>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">{{env('APP_NAME','License Management System')}}</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-center w-lg-50 p-10">
                <!--begin::Card-->
            @yield('content')
            <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('sets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="{{ asset('sets/js/custom/authentication/sign-in/general.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    </body>
@endsection