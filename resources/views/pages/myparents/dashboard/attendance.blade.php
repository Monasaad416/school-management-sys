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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"  action="{{ route('sons_attendance.search') }}" autocomplete="off">
                    @csrf
                    <h6>{{trans('attendance_trans.search_info')}}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{trans('students_trans.students_list')}}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{trans('attendance_trans.all')}}</option>
                                    @foreach($sons as $son)
                                        <option value="{{ $son->id }}">{{ $son->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <span class="input-group-addon">{{trans('attendance_trans.from_date')}}</span>
                                <input type="text"  class="form-control range-from date-picker-default" placeholder="{{trans('attendance_trans.start_date')}}" required name="from">
                                <span class="input-group-addon">{{trans('attendance_trans.to_date')}}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{trans('attendance_trans.end_date')}}" type="text" required name="to">
                            </div>
                        </div>

                    </div>
                    <button class="button btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection