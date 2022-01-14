@extends('layouts.main') 
@section('title', 'الفئات')
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
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('الفئات')}}</h5>
                            <span>{{ __('قائمة الفئات')}}</span>
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
                                <a href="categories">{{ __('الفئات')}}</a>
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
                        <h3>{{ __('الفئات')}}</h3>
                        <div class="col col-sm-2">
                            <a href="{{route('create-category')}}" class="btn btn-sm btn-primary">إضافة فئة </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="category_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('الأسم')}}</th>
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
    <script src="{{ asset('js/categories.js') }}"></script>
    @endpush
@endsection
