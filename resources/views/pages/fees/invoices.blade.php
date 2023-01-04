@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('fees_trans.invoice')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('fees_trans.invoice')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('students_trans.student_name')}}</th>
                                            <th>{{trans('fees_trans.fees_type')}}</th>
                                            <th>{{trans('fees_trans.amount')}}</th>
                                            <th>{{trans('students_trans.grade')}}</th>
                                            <th>{{trans('students_trans.level')}}</th>
                                            <th>{{trans('fees_trans.notes')}}</th>
                                            <th>{{trans('fees_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$invoice->student->name}}</td>
                                            <td>{{$invoice->fee->title}}</td>
                                            <td>{{ number_format($invoice->amount,2) }}</td>
                                            <td>{{$invoice->grade->name}}</td>
                                            <td>{{$invoice->level->name}}</td>
                                            <td>{{$invoice->description}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm"data-toggle="modal" data-target="#delete_invoice_item{{$invoice->id}}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            {{-- delete invoice item --}}
                                          @include('pages.fees.delete_invoice')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
