@extends('layouts.master')
@section('css')
@livewireStyles
@toastr_css

@section('title')
    {{trans('quiz_trans.start_exam')}}
@endsection
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('quiz_trans.start_exam')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('quiz_trans.start_exam')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @livewire('show-question' ,['quiz_id'=>$quiz_id ,'quiz_details'=>$quiz_details])
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@livewireScripts
@stack('scripts')
@toastr_js
@toastr_render


@endsection
