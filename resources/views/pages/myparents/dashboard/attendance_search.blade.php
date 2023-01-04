@extends('layouts.master')
@section('css')

@section('title')
    {{trans('attendance_trans.attendance_reports')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('attendance_trans.attendance_reports')}}
@stop
<!-- breadcrumb -->

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('students_trans.name')}}</th>
                            <th class="alert-success">{{trans('students_trans.grade')}}</th>
                            <th class="alert-success">{{trans('students_trans.section')}}</th>
                            <th class="alert-success">{{trans('attendance_trans.date')}}</th>
                            <th class="alert-warning">{{trans('attendance_trans.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sons as $attend)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$attend->student->name}}</td>
                                <td>{{$attend->grade->name}}</td>
                                <td>{{$attend->section->name}}</td>
                                <td>{{$attend->attendance_date}}</td>
                                <td>
                                    @if($attend->attendance_status == 0)
                                        <span class="btn-danger px-2 py-1">{{trans('attendance_trans.absent')}}</span>
                                    @else
                                        <span class="btn-success px-2 py-1">{{trans('attendance_trans.attend')}}</span>
                                    @endif
                                </td>
                            </tr>
                        {{-- @include('pages.Students.Delete') --}}
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
