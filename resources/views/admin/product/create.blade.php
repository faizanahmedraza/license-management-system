@extends('admin.layout.master')

@section('styles')
    @parent
    <style></style>
@endsection

@section('breadcrumb-title')
    Add Product
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
                                <!--begin::Form-->
                                <form id="kt_customer_form" class="form" method="POST"
                                      action="{{route('admin.products.store')}}"
                                      enctype="multipart/form-data">
                                @csrf
                                <!--begin::errors-alert-->
                                @include('partials._errors')
                                <!--end::errors-alert-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name') }}</label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <input type="text" name="name"
                                                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                               placeholder="Name"
                                                               value="{{ old('name') }}"/>
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
                                                        class="required">{{ __('Short Code') }}</span></label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="short_code"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Short Code"
                                                       value="{{ old('short_code') }}"/>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                <span class="required">{{ __('Version Number') }}</span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="number" name="version_number"
                                                       class="form-control form-control-lg form-control-solid"
                                                       placeholder="Version Number"
                                                       value="{{ old('version_number') }}"/>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                {{ __('Description') }}
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <textarea rows="5" class="form-control form-control-lg form-control-solid" name="description" placeholder="Description">{{old('description')}}</textarea>
                                            </div>
                                            <!--end::Col-->
                                        </div>
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
