@extends('layouts.master')
@section('css')



@section('title')
    {{trans('sidebar_trans.parents')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col">
            <h4 class="mb-0">{{trans('parent_trans.all_parents')}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-4 my-4">
            <button class="button btn-sm btn-primary"><a href="{{url('add_parent')}}">{{trans('sidebar_trans.add_parent')}}</a></button>
        </div>
        <div class="col-4">
            <ol class="breadcrumb pt-0 pr-0 ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
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
                <livewire:show-parents />
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection
