@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ $productsCount }}</h4>
                                <p class="mb-0">{{ __('المنتجات')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$orders}}</h4>
                                <p class="mb-0">{{ __('الطلبات')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$stores_count}}</h4>
                                <p class="mb-0">{{ __('المحلات')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ $category}}</h4>
                                <p class="mb-0">{{ __('الفئات')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
 

            <!-- product and new customar start -->
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>{{ __('محلات جديدة')}}</h3>
                    </div>
                    <div class="card-block">
                        @foreach ($stores as $store)
                        <div class="align-middle mb-25">
                            <img src="{{$store->hasMedia('image') ? $store->getFirstMediaUrl('image', 'thumb')  : '../img/download.png'}}" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="stores"><h6>{{$store->name}}</h6></a>
                                <p class="text-muted mb-0">{{ $store->phone}}</p>
                                <!-- <span class="status active"></span> -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('المنتجات')}}</h3>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('الاسم')}}</th>
                                        <th>{{ __('السعر')}}</th>
                                        <th>{{ __('الفئة')}}</th>
                                        <th>{{ __('عمل')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->category ? $product->category->name : ''}}</td>
                                            <td>
                                                <a href="{{route('products.edit', $product->id)}}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="{{route('products.destroy', $product->id)}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- product and new customar end -->
    	</div>
    </div>
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
       
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
        
    @endpush
@endsection