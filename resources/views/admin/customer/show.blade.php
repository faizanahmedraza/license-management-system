@extends('admin.layout.master')

@section('styles')
    @parent
    <style></style>
@endsection

@section('breadcrumb-title')
    Customer Detail
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
                                            <div class="image-input image-input-outline {{ isset($customer->info) && $customer->info->avatar ? '' : 'image-input-empty' }}"
                                                 data-kt-image-input="true"
                                                 style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px"
                                                     style="background-image: {{ isset($customer->info) && $customer->info->avatar_url ? 'url('.asset($customer->info->avatar_url).')' : 'none' }};"></div>
                                                <!--end::Preview existing avatar-->
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
                                                           value="{{ old('first_name',$customer->first_name) }}" readonly/>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="last_name"
                                                           class="form-control form-control-lg form-control-solid"
                                                           placeholder="Last name"
                                                           value="{{ old('last_name',$customer->last_name) }}" readonly/>
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
                                                   value="{{ old('email',$customer->email) }}" readonly/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                                            <span class="required">{{ __('Contact Phone') }}</span>

                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="{{ __('Phone number must be active') }}"></i>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="tel" name="phone"
                                                   class="form-control form-control-lg form-control-solid"
                                                   placeholder="Phone number"
                                                   value="{{ old('phone',$customer->info->phone) }}" readonly/>
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
                                                    class="form-select form-select-solid form-select-lg fw-bold" disabled>
                                                <option value="">{{ __('Select a Country...') }}</option>
                                                @foreach(\App\Core\Data::getCountriesList() as $key => $value)
                                                    <option data-kt-flag="{{ $value['flag'] }}"
                                                            value="{{ $key }}" {{ $key === old('country',$customer->info->country) ? 'selected' :'' }}>{{ $value['name'] }}</option>
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
                                            {{ __('Status') }}

                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="{{ __('Status of Customer') }}"></i>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <select name="status" aria-label="{{ __('Select...') }}"
                                                    data-control="select2"
                                                    data-placeholder="{{ __('Select...') }}"
                                                    class="form-select form-select-solid form-select-lg fw-bold" disabled>
                                                <option value="">{{ __('Select...') }}</option>
                                                @foreach($statuses as $key => $val)
                                                    <option value="{{ $key }}" {{ old('status',$customer->status) === $val ? 'selected' :'' }}>{{ __($key) }}</option>
                                                @endforeach
                                            </select>
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
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
                <!--end::Content container-->
            </div>
            <!--end::Card-->
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
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
@endpush
