@extends('layouts.main') 
@section('title', 'تعديل المدينة')
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
                        <i class="ik ik-map-pin bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('تعديل المدينة')}}</h5>
                            <span>{{ __('تعديل المدينة ')}}</span>
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
                                <a href="#">{{ __('تعديل المدينة')}}</a>
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
                        <h3>{{ __('تعديل مدينة')}}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($city, ['route' => ['cities.update', $city->id], 'method' => 'patch', 'class' => 'forms-sample']) !!}
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('أسم المدينة')}}<span class="text-red">*</span></label>
                                        <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($city->name, 'name')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="emirate_id">{{ __('اختر الأماره')}}<span class="text-red">*</span></label>
                                    {!! Form::select('emirate_id', $emirates, $city->emirate_id ?? null,[ 'class'=>'form-control select2', 'placeholder' => 'حدد الأماره','id'=> 'emirate_id', 'required'=> 'required']) !!}
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
