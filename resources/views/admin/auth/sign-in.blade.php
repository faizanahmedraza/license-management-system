@extends('admin.auth.master')

@section('styles')
    @parent
    <style>

    </style>
@endsection

@section('content')
    <div class="card rounded-3 w-md-550px">
        <!--begin::Card body-->
        <div class="card-body p-10 p-lg-20">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                  action="{{route('admin.postLogin')}}">
            @csrf
            <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">{{__('Login to the system')}}</h1>
                    <!--end::Title-->
                </div>
                <!--begin::Heading-->
                <!--begin::errors-alert-->
            @include('partials._errors')
            <!--end::errors-alert-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="{{__('Email')}}" name="email" autocomplete="off"
                           class="form-control bg-transparent"/>
                    <!--end::Email-->
                </div>
                <!--end::Input group=-->
                <div class="fv-row mb-3">
                    <!--begin::Password-->
                    <input type="password" placeholder="{{__('Password')}}" name="password" autocomplete="off"
                           class="form-control bg-transparent"/>
                    <!--end::Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Input group-->
                <div class="fv-row mb-3">
                    <label class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="remember_me" value="1"/>
                        <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <!--end::Input group-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">{{__('Sign In')}}</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Submit button-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
@endsection