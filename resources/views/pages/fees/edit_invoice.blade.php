@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('fees_trans.edit_invoice')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('fees_trans.edit_invoice')}}
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

                    <form action="{{route('invoices.update',$invoice->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('students_trans.student_name')}}</label>
                                <input type="text" value="{{$invoice->student->name}}" readonly name="title_ar" class="form-control">
                                <input type="hidden" value="{{$invoice->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('fees_trans.amount')}}</label>
                                <input type="number" value="{{$invoice->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip">{{trans('fees_trans.fees_type')}}</label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" {{$fee->id == $invoice->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('fees_trans.notes')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$invoice->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="button">{{trans('students_trans.submit')}}</button>

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
