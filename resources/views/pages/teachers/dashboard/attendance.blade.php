@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('attendance.students_list') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('attendance.students_list') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">
                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                 <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{trans('attendance_trans.date_today')}} : {{ date('Y-m-d') }}</h5>
                                                <form method="post" action="{{ route('t_attendance.store','test') }}">
                                                    @csrf
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{ trans('studs_trans.name') }}</th>
                                                                <th>{{ trans('attendance_trans.grade') }}</th>
                                                                <th>{{ trans('attendance_trans.section') }}</th>
                                                                <th>{{ trans('attendance_trans.level') }}</th>
                                                                <th>{{ trans('attendance_trans.status') }}</th>
                                                                <th>{{ trans('attendance_trans.actions') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($students_teacher as $key => $stud)
                                                                    <tr>
                                                                        <td>{{ $loop ->iteration}}</td>
                                                                        <td>{{ $stud->name }}</td>
                                                                        <td>{{ $stud->grade->name }}</td>
                                                                        <td>{{ $stud->level->name }}</td>
                                                                        <td>{{ $stud->section->name }}</td>
                                                                        <td>
                                                                            <label class="badge badge-{{$stud->status == 1 ? 'success':'danger'}}">
                                                                                {{
                                                                                $stud->status == 1 ?
                                                                                trans("attendance_trans.active"):
                                                                                trans("attendance_trans.inactive")
                                                                                }}
                                                                            </label>
                                                                        </td>

                                                                        <td>

                                                                            @if(isset($stud->attendance()->where('attendance_date',date('Y-m-d'))->first()->student_id))
                                                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                                                    <input name="attendances[{{ $stud->id }}]" disabled
                                                                                        {{ $stud->attendance->first()->attendance_status == true ? 'checked' : '' }}
                                                                                        class="leading-tight" type="radio" value="present">
                                                                                    <span class="text-success">{{ trans('attendance_trans.attend') }}</span>
                                                                                </label>

                                                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                                                    <input name="attendances[{{ $stud->id }}]" disabled
                                                                                        {{ $stud->attendance()->first()->attendance_status == false ? 'checked' : '' }}
                                                                                        class="leading-tight" type="radio" value="absent">
                                                                                    <span class="text-danger">{{ trans('attendance_trans.absent') }}</span>
                                                                                </label>

                                                                            @else

                                                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                                                    <input name="attendances[{{ $stud->id }}]" class="leading-tight" type="radio"
                                                                                        value="present">
                                                                                    <span class="text-success">{{ trans('attendance_trans.attend') }}</span>
                                                                                </label>

                                                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                                                    <input name="attendances[{{ $stud->id }}]" class="leading-tight" type="radio"
                                                                                        value="absent">
                                                                                    <span class="text-danger">{{ trans('attendance_trans.absent') }}</span>
                                                                                </label>

                                                                            @endif


                                                                            <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#edit_attendance{{$stud->id}}">
                                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                            </button>
                                                                            @include('pages.teachers.dashboard.edit_attendance')

                                                                            <input type="hidden" name="stud_id[]" value="{{ $stud->id }}">
                                                                            <input type="hidden" name="grade_id" value="{{ $stud->grade_id }}">
                                                                            <input type="hidden" name="level_id" value="{{ $stud->level_id }}">
                                                                            <input type="hidden" name="section_id" value="{{ $stud->section_id }}">

                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <P>
                                                        <button class="btn button" type="submit">{{ trans('Students_trans.submit') }}</button>
                                                    </P>
                                                </form>
                                            </div>
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
