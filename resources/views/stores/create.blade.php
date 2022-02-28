@extends('layouts.main') 
@section('title', 'إضافة محل')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('إضافة محل')}}</h5>
                            <span>{{ __('إنشاء محل جديد ')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('إضافة محل')}}</a>
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
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('إضافة محل')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('stores.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('أسم المحل')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="ادخل اسم المحل" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{ __(' البريد الألكتروني')}}<span class="text-red">*</span></label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="phone" value="" placeholder="ادخل البريد الألكتروني" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="phone">{{ __('رقم المحل')}}<span class="text-red">*</span></label>
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="" placeholder="ادخل رقم المحل" required>
                                        <div class="help-block with-errors"></div>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="password">{{ __('كلمة السر')}}<span class="text-red">*</span></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" placeholder="ادخل كلمة السر" required>
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">{{ __('صورة المحل')}}<span class="text-red">*</span></label>
                                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="أضف صورة المحل">
                                        <div class="help-block with-errors"></div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="commercial_register">{{ __('صورة السجل التجاري')}}<span class="text-red">*</span></label>
                                        <input id="commercial_register" type="file" class="form-control @error('commercial_register') is-invalid @enderror" name="commercial_register" placeholder="أضف صورة السجل التجاري">
                                        <div class="help-block with-errors"></div>
                                        @error('commercial_register')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emirate_id">{{ __('حدد الأماراه')}}<span class="text-red">*</span></label>
                                            {!! Form::select('emirate_id', $emirates, $store->emirate_id ?? null ,[ 'class'=>'form-control select2', 'placeholder' => 'حدد الأماراه','id'=> 'emirate_id', 'required'=> 'required']) !!}
                                        </div>
                                        <div class="form-group" >
                                            <label for="city_id">{{ __('المدينة')}}</label>
                                            {!! Form::select('city_id', $cities,  $store->city_id ?? null,[ 'class'=>'form-control select2', 'placeholder' => 'حدد المدينة','id'=> 'city_id', 'required'=> 'required']) !!}
                                        </div>


                                        <div class="form-group">
                                            <label for="street">{{ __('أسم الشارع')}}<span class="text-red">*</span></label>
                                            <input id="passtreetsword" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="" placeholder="أسم الشارع">
                                        </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('حفظ')}}</button>
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/get-city.js') }}"></script>
    @endpush
@endsection
