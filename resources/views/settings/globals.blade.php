@extends('layouts.main') 
@section('title', 'الأعدادات')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/summernote/dist/summernote-bs4.css') }}">
    @endpush
    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('الأعدادات')}}</h5>
                            <span>{{ __('الأعدادات النظام')}}</span>
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
                                <a href="settings">{{ __('الأعدادات')}}</a>
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('شروط الضمان')}}</h3></div>
                    {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
                    <div class="card-body">
                        {!! Form::textarea('warranty_terms', $warranty_terms   ?? null, ['class' => 'form-control html-editor','placeholder'=> 'اكتب شروط الضمان'  ]) !!}
                        <!-- <textarea class="form-control html-editor" rows="20"></textarea> -->
                    </div>
                    <div class="form-group mt-4 col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{__('حفظ شروط الضمان')}}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('إرشادات الاستخدام')}}</h3></div>
                    {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
                        <div class="card-body">
                            {!! Form::textarea('instructions_for_user', $instructions_for_user ?? null, ['class' => 'form-control html-editor','placeholder'=>__('اكتب إرشادات الاستخدام')  ]) !!}
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group mt-4 col-12 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{__('حفظ إرشادات الاستخدام')}}
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('الشركات التي ينصح بها')}}</h3></div>
                    {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
                        <div class="card-body">
                            {!! Form::textarea('companies', $companies ?? null, ['class' => 'form-control html-editor','placeholder'=>__('اكتب الشركات التي ينصح بها ')  ]) !!}
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group mt-4 col-12 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{__('حفظ ')}}
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('الشروط والأحكام')}}</h3></div>
                    {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
                        <div class="card-body">
                            {!! Form::textarea('terms_conditions', $terms_conditions ?? null, ['class' => 'form-control html-editor','placeholder'=>__('اكتب الشروط والأحكام ')  ]) !!}
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group mt-4 col-12 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{__('حفظ ')}}
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
    @endpush
@endsection
