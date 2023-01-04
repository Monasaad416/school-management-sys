@extends('layouts.master')
@section('css')

@section('title')
  {{trans('sec_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('sec_trans.page_title')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('students_trans.grade')}}</th>
                                <th>{{trans('students_trans.section')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sections_teacher as $section)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $section->grade->name }}</td>
                                    <td>{{ $section->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
@endsection
