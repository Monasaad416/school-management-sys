@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('fees_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('fees_trans.page_title')}}
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
                                <a href="{{route('fees.create')}}" class="button btn-sm" role="button"
                                   aria-pressed="true">{{trans('fees_trans.add_fees')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('fees_trans.name')}}</th>
                                            <th>{{trans('fees_trans.amount')}}</th>
                                            <th>{{trans('fees_trans.grade')}}</th>
                                            <th>{{trans('fees_trans.level')}}</th>
                                            <th>{{trans('fees_trans.desc')}}</th>
                                            <th>{{trans('fees_trans.academic_year')}}</th>
                                            <th>{{trans('fees_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$fee->title}}</td>
                                                <td>{{ number_format($fee->amount, 2) }}</td>
                                                <td>{{$fee->grade->name}}</td>
                                                <td>{{$fee->level->name}}</td>
                                                <td>{{$fee->description}}</td>
                                                <td>{{$fee->academic_year}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('grades_trans.delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.fees.delete')
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
