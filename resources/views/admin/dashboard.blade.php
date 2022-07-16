@extends('admin.layout.master')

@section('styles')
    @parent
    <style></style>
@endsection

@section('breadcrumb-title')
    {{ __('Dashboard') }}
@endsection

@section('header-actions')

@endsection

@section('content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
        @include('partials._success')
        @php
            $chartColor = $chartColor ?? 'primary';
            $chartHeight = $chartHeight ?? '30px';
        @endphp

        <!--begin::Mixed Widget 2-->
            <div class="card card-xxl-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 bg-{{ $chartColor }} py-5">
                    <h3 class="card-title fw-bolder text-white">{{ __('Statistics') }}</h3>

                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button"
                                class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-{{ $color ?? '' }} border-0 me-n3"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        </button>
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body p-0">
                    <!--begin::Chart-->
                    <div class="mixed-widget-2-chart card-rounded-bottom bg-{{ $chartColor }}"
                         data-kt-color="{{ $chartColor }}" style="height: {{ $chartHeight }}"></div>
                    <!--end::Chart-->

                    <!--begin::Stats-->
                    <div class="card-p mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col d-flex justify-content-between bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                <a href="{{route('admin.customers.index')}}" class="text-warning fw-bold fs-6">
                                    Customers
                                </a>
                                <strong>{{$customerCount}}</strong>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col d-flex justify-content-between bg-light-primary px-6 py-8 rounded-2 mb-7">
                                <a href="{{route('admin.products.index')}}" class="text-primary fw-bold fs-6">
                                    Products
                                </a>
                                <strong>{{$productCount}}</strong>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col d-flex justify-content-between bg-light-danger px-6 py-8 rounded-2 ms-7 mb-7">
                                <a href="{{route('admin.licenses.index')}}" class="text-danger fw-bold fs-6 mt-2">
                                    Licenses
                                </a>
                                <strong>{{$licenseCount}}</strong>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col bg-light-secondary px-6 py-8 rounded-2 me-7">
                                <h4 class="fw-bold">Latest Licenses</h4>
                            @forelse($licenses as $row)
                                <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <!--begin::Bullet-->
                                        <span class="bullet bullet-vertical h-40px me-5"></span>
                                        <!--end::Bullet-->

                                        <!--begin::Description-->
                                        <div class="flex-grow-1">
                                            <a href="{{route('admin.licenses.show',['id'=>$row['id']])}}"
                                               class="text-gray-800 text-hover-primary fw-bolder fs-6">{{ $row['license_code'] }}</a>

                                            <span class="text-muted fw-bold d-block">{{ $row['license_type'] }}</span>
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end:Item-->
                                @empty
                                @endforelse
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 2-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
@endsection
