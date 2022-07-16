@extends('admin.layout.master')

@section('styles')
    @parent
    <style></style>
@endsection

@section('breadcrumb-title')
    My Account
@endsection

@section('header-actions')

@endsection

@section('content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6 mb-md-5 mb-xl-10">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-6">
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <!--begin::Content-->
                            <div id="kt_account_profile_details" class="collapse show">
                                <!--begin::Form-->
                                <form id="kt_customer_form" class="form" method="POST"
                                      action="{{route('admin.settings.update')}}"
                                      enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::errors-alert-->
                                @if(! session()->has('signin_method'))
                                    @include('partials._errors')
                                @endif
                                <!--end::success-alert-->
                                    <!--begin::errors-alert-->
                                @include('partials._success')
                                <!--end::success-alert-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Avatar') }}</label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline {{ isset($info) && $info->avatar ? '' : 'image-input-empty' }}"
                                                     data-kt-image-input="true"
                                                     style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                         style="background-image: {{ isset($info) && $info->avatar_url ? 'url('.asset($info->avatar_url).')' : 'none' }};"></div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                           data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                           title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="avatar_remove"/>
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                          data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                          title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                          data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                          title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Hint-->
                                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full Name') }}</label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-6 fv-row">
                                                        <input type="text" name="first_name"
                                                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                               placeholder="First name"
                                                               value="{{ old('first_name',auth()->user()->first_name) }}"/>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-lg-6 fv-row">
                                                        <input type="text" name="last_name"
                                                               class="form-control form-control-lg form-control-solid"
                                                               placeholder="Last name"
                                                               value="{{ old('last_name',auth()->user()->last_name) }}"/>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6"><span
                                                        class="required">{{ __('Email') }}</span></label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="email"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Email"
                                                       value="{{ old('email',auth()->user()->email) }}"/>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                {{ __('Contact Phone') }}

                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                   title="{{ __('Phone number must be active') }}"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="tel" name="phone"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Phone number"
                                                       value="{{ old('phone',$info->phone ?? "") }}"/>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                {{ __('Country') }}

                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                   title="{{ __('Country of origination') }}"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <select name="country" aria-label="{{ __('Select a Country') }}"
                                                        data-control="select2"
                                                        data-placeholder="{{ __('Select a country...') }}"
                                                        class="form-select form-select-solid form-select-lg fw-bold">
                                                    <option value="">{{ __('Select a Country...') }}</option>
                                                    @foreach(\App\Core\Data::getCountriesList() as $key => $value)
                                                        <option data-kt-flag="{{ $value['flag'] }}"
                                                                value="{{ $key }}" {{ $key === old('country',$info->country ?? "") ? 'selected' :'' }}>{{ $value['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                {{ __('Short Description') }}

                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                   title="{{ __('Short description about yourself') }}"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <textarea rows="3" name="short_desc"
                                                          class="form-control form-control-lg form-control-solid"
                                                          placeholder="Description">{{old('short_desc',$info->short_desc ?? "")}}</textarea>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        {{--                                        <!--begin::Input group-->--}}
                                        {{--                                        <div class="row mb-6">--}}
                                        {{--                                            <!--begin::Label-->--}}
                                        {{--                                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Language') }}</label>--}}
                                        {{--                                            <!--end::Label-->--}}

                                        {{--                                            <!--begin::Col-->--}}
                                        {{--                                            <div class="col-lg-8 fv-row">--}}
                                        {{--                                                <!--begin::Input-->--}}
                                        {{--                                                <select name="language" aria-label="{{ __('Select a Language') }}"--}}
                                        {{--                                                        data-control="select2"--}}
                                        {{--                                                        data-placeholder="{{ __('Select a language...') }}"--}}
                                        {{--                                                        class="form-select form-select-solid form-select-lg">--}}
                                        {{--                                                    <option value="">{{ __('Select a Language...') }}</option>--}}
                                        {{--                                                    @foreach(\App\Core\Data::getLanguagesList() as $key => $value)--}}
                                        {{--                                                        <option data-kt-flag="{{ $value['country']['flag'] }}"--}}
                                        {{--                                                                value="{{ $key }}" {{ $key === old('language', $info->language ?? '') ? 'selected' :'' }}>{{ $value['name'] }}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </select>--}}
                                        {{--                                                <!--end::Input-->--}}

                                        {{--                                                <!--begin::Hint-->--}}
                                        {{--                                                <div class="form-text">--}}
                                        {{--                                                    {{ __('Please select a preferred language, including date, time, and number formatting.') }}--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <!--end::Hint-->--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Col-->--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <!--end::Input group-->--}}

                                        {{--                                        <!--begin::Input group-->--}}
                                        {{--                                        <div class="row mb-6">--}}
                                        {{--                                            <!--begin::Label-->--}}
                                        {{--                                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Time Zone') }}</label>--}}
                                        {{--                                            <!--end::Label-->--}}

                                        {{--                                            <!--begin::Col-->--}}
                                        {{--                                            <div class="col-lg-8 fv-row">--}}
                                        {{--                                                <select name="timezone" aria-label="{{ __('Select a Timezone') }}"--}}
                                        {{--                                                        data-control="select2"--}}
                                        {{--                                                        data-placeholder="{{ __('Select a timezone..') }}"--}}
                                        {{--                                                        class="form-select form-select-solid form-select-lg">--}}
                                        {{--                                                    <option value="">{{ __('Select a Timezone..') }}</option>--}}
                                        {{--                                                    @foreach(\App\Core\Data::getTimeZonesList() as $key => $value)--}}
                                        {{--                                                        <option data-bs-offset="{{ $value['offset'] }}"--}}
                                        {{--                                                                value="{{ $key }}" {{ $key === old('timezone', $info->timezone ?? '') ? 'selected' :'' }}>{{ $value['name'] }}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </select>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <!--end::Col-->--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <!--end::Input group-->--}}
                                    </div>
                                    <!--end::Card body-->

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="reset"
                                                class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>

                                        <button type="submit" class="btn btn-primary"
                                                id="kt_customer_submit">
                                            @include('partials._button-indicator', ['label' => __('Save')])
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
                <!--end::Content container-->
            </div>
            <!--end::Card-->
        @include('admin.account._signin-method')
        <!--end::Content-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
@endsection

@push('scripts')
    <!--begin::Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script>
        var signInMainEl = document.getElementById('kt_signin_email');
        var signInEditEl = document.getElementById('kt_signin_email_edit');
        var passwordMainEl = document.getElementById('kt_signin_password');
        var passwordEditEl = document.getElementById('kt_signin_password_edit');

        // button elements
        var signInChangeEmail = document.getElementById('kt_signin_email_button');
        var signInCancelEmail = document.getElementById('kt_signin_cancel');
        var passwordChange = document.getElementById('kt_signin_password_button');
        var passwordCancel = document.getElementById('kt_password_cancel');

        var toggleChangeEmail = function () {
            signInMainEl.classList.toggle('d-none');
            signInChangeEmail.classList.toggle('d-none');
            signInEditEl.classList.toggle('d-none');
        }

        var toggleChangePassword = function () {
            passwordMainEl.classList.toggle('d-none');
            passwordChange.classList.toggle('d-none');
            passwordEditEl.classList.toggle('d-none');
        }
        // toggle UI
        signInChangeEmail.querySelector('button').addEventListener('click', function () {
            toggleChangeEmail();
        });

        signInCancelEmail.addEventListener('click', function () {
            toggleChangeEmail();
        });

        passwordChange.querySelector('button').addEventListener('click', function () {
            toggleChangePassword();
        });

        passwordCancel.addEventListener('click', function () {
            toggleChangePassword();
        });

        $("#kt_password_submit").click(function () {
            $(this).parents('form:first').submit();
        });
        $("#kt_signin_submit").click(function () {
            $(this).parents('form:first').submit();
        });
    </script>
@endpush
