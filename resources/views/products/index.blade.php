@extends('layouts.main') 
@section('title', 'المنتجات')
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
                            <h5>{{ __('المنتجات')}}</h5>
                            <span>{{ __('قائمة المنتجات')}}</span>
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
                                <a href="products">{{ __('المنتجات')}}</a>
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
                        <h3>{{ __('المنتجات')}}</h3>
                        <div class="col col-sm-2">
                            <a href="{{route('products.create')}}" class="btn btn-sm btn-primary">إضافة منتج </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="product_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('الأسم')}}</th>
                                    <th>{{ __('السعر')}}</th>
                                    <th>{{ __('الفئة')}}</th>
                                    <th>{{ __('عمل')}}</th>
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
    <script src="{{ asset('js/product.js') }}"></script>
    @endpush
@endsection
