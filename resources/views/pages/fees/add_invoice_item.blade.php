@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
     {{trans('fees_trans.add_invoice_item')}} {{$student->name}}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
 {{trans('fees_trans.add_invoice_item')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h6 class="my-3">{{trans('fees_trans.add_invoice_item')}}</h3>
                    <form class="row mb-30" action="{{ route('invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="list_fees">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="name" class="mr-sm-2">{{trans('students_trans.student_name')}}</label>
                                                <select class="fancyselect" name="student_id" >
                                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="name_en" class="mr-sm-2">{{trans('fees_trans.fees_type')}}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id" >
                                                        <option value="">{{trans('parent_trans.choose')}}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{trans('fees_trans.amount')}}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="amount" >
                                                        <option value="">{{trans('parent_trans.choose')}}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description" class="mr-sm-2">{{trans('fees_trans.notes')}}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description" >
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('fees_trans.delete_row') }}:</label>
                                                <input class="button-danger btn-block" data-repeater-delete type="button" value="{{ trans('fees_trans.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('fees_trans.add_row') }}"/>
                                    </div>
                                </div><br>
                                <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                <input type="hidden" name="level_id" value="{{$student->level_id}}">

                                <button type="submit" class="button float-right">{{ trans('students_trans.submit') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

@endsection
