@extends('layouts.main') 
@section('title', 'الطلبات')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-headphones bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('الطلبات')}}</h5>
                            <span>{{ __('قائمة الطلبات')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="orders">{{ __('الطلبات')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header row">
                        <h3>{{ __('الطلبات')}}</h3>
                    </div>
                    <div class="card-body">
                        <table id="order_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('ID')}}</th>
                                    <th>{{ __('المحل')}}</th>
                                    <th>{{ __('العميل')}}</th>
                                    <th>{{ __('الرقم التسلسلي')}}</th>
                                    <th>{{ __('المنتج')}}</th>
                                    <th>{{ __('تاريخ التركيب')}}</th>
                                    <th>{{ __('الوقت المتبقي')}}</th>
                                    <th>{{ __('تاريخ انتهاء')}}</th>
                                    <th>{{ __('تاريخ الأسترجاع')}}</th>
                                    <th>{{ __(' كود الأسترجاع')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/orders.js') }}"></script>
    @endpush
@endsection
