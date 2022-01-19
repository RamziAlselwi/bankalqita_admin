@extends('layouts.main') 
@section('title', $store->name)
@section('content')


    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('محل')}}</h5>
                            <span>{{ $store->name}}</span>
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
                                <a href="{{url('stores')}}">{{ __('المحلات')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="{{$store->getFirstMediaUrl('image', 'thumb')}}" class="img-fluid" alt="">
            </div>
            <div class="col-2">
                <h3 class="text-danger">
                    {{$store->name}}
                </h3>
                <p class="text-green"> {{$store->phone}}</p>
                <p class="text-green">{{$store->emirate()->exists() ? $store->emirate->name : '-'}}</p>
                <p class="text-green">{{$store->city()->exists() ? $store->city->name : '-'}}</p>
            </div>
            <div class="col-4">
                <img src="{{$store->getFirstMediaUrl('commercial_register', 'thumb')}}" class="img-fluid" alt="">
            </div>
            <div class="col-2">
                <h3 class="text-danger">
                    السجل التجاري
                </h3>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/stores.js') }}"></script>
    @endpush
@endsection
