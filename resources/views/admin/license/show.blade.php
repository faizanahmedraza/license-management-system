@extends('admin.layout.master')

@section('styles')
    @parent
    <style></style>
@endsection

@section('breadcrumb-title')
    License Detail
@endsection

@section('header-actions')

@endsection

@section('content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
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
                                        <label class="col-lg-4 col-form-label fw-bold fs-6 required">
                                            {{ __('Customer Name') }}

                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="{{ __('Customer Name') }}"></i>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <select name="user_id" aria-label="{{ __('Select a Customer') }}"
                                                    data-control="select2"
                                                    data-placeholder="{{ __('Select a customer...') }}"
                                                    class="form-select form-select-solid form-select-lg fw-bold" disabled>
                                                <option value="">{{ __('Select a Customer...') }}</option>
                                                @foreach($customers as $key => $value)
                                                    <option value="{{ $value->id }}" {{ (int)old('user_id',$license->user_id) === $value->id ? 'selected' :'' }}>{{ $value->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6 required">
                                            {{ __('Product Name') }}

                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                               title="{{ __('Product Name') }}"></i>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <select name="product_id" aria-label="{{ __('Select a Product') }}"
                                                    data-control="select2"
                                                    data-placeholder="{{ __('Select a product...') }}"
                                                    class="form-select form-select-solid form-select-lg fw-bold" disabled>
                                                <option value="">{{ __('Select a Product...') }}</option>
                                                @foreach($products as $key => $value)
                                                    <option value="{{ $value->id }}" {{ (int)old('product_id',$license->product_id) === $value->id ? 'selected' :'' }}>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('License Code') }}</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <input type="text" name="license_code"
                                                           class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                           placeholder="License Code"
                                                           value="{{ old('license_code',$license->license_code) }}" readonly/>
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
                                                    class="required">{{ __('License Type') }}</span></label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <select name="license_type"
                                                    aria-label="{{ __('Select a License Type') }}"
                                                    data-control="select2"
                                                    data-placeholder="{{ __('Select a license Type...') }}"
                                                    class="form-select form-select-solid form-select-lg fw-bold" disabled>
                                                <option value="">{{ __('Select a License Type...') }}</option>
                                                @foreach($licenseTypes as $value)
                                                    <option value="{{ $value }}" {{ old('license_type',$license->license_type) === $value ? 'selected' :'' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6 required">
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
                                                    <option value="{{ $key }}" {{ (int)old('status',$license->status) === $val ? 'selected' :'' }}>{{ __($key) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6 expiry">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6 required">
                                            {{ __('Select Expiry Date') }}
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input class="form-control form-control-solid"
                                                   placeholder="Pick a date" name="expiry" disabled/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
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
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/sl.js"></script>
    <script>
        var type = "{{old('license_type',$license->license_type)}}";
        if (type == "neomejeno") {
            $(".expiry").hide();
        }
        const e = document.querySelector("[name=expiry]");
        $(e).flatpickr({altInput: !0, altFormat: "F j, Y", dateFormat: "Y-m-d", defaultDate: "{{$license->expiry}}"})
    </script>
@endpush
