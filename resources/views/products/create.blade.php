@extends('layouts.main') 
@section('title', 'إضافة منتج')
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
                        <i class="ik ik-headphones bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('إضافة منتج')}}</h5>
                            <span>{{ __('إنشاء منتج جديد ')}}</span>
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
                                <a href="#">{{ __('إضافة منتج')}}</a>
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
                        <h3>{{ __('إضافة منتج')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('products.store') }}" >
                        @csrf
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('أسم منتج')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="ادخل اسم المنتج" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">{{ __('السعر')}}<span class="text-red">*</span></label>
                                        <input id="price" type="numberdd" class="form-control @error('price') is-invalid @enderror" name="price" value="" placeholder="ادخل سعر المنتج" required>
                                        <div class="help-block with-errors"></div>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">{{ __('اختر الفئة')}}<span class="text-red">*</span></label>
                                        {!! Form::select('category_id', $categories, null,[ 'class'=>'form-control select2', 'placeholder' => 'حدد الفئة','id'=> 'category_id', 'required'=> 'required']) !!}
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

@endsection
