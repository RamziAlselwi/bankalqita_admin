@extends('layouts.main') 
@section('title', 'تعديل منتج')
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
                            <h5>{{ __('تعديل منتج')}}</h5>
                            <span>{{ __('تعديل منتج ')}}</span>
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
                                <a href="#">{{ __('تعديل منتج')}}</a>
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
                        <h3>{{ __('تعديل منتج')}}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'class' => 'forms-sample']) !!}
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('أسم منتج')}}<span class="text-red">*</span></label>
                                        <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($product->name, 'name')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">{{ __('السعر')}}<span class="text-red">*</span></label>
                                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ clean($product->price, 'price')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">{{ __('اختر الفئة')}}<span class="text-red">*</span></label>
                                        {!! Form::select('category_id', $categories, $product->category_id ?? null,[ 'class'=>'form-control select2', 'placeholder' => 'حدد الفئة','id'=> 'category_id', 'required'=> 'required']) !!}
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('تعديل')}}</button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
