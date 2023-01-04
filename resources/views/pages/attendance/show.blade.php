@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('attendance_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('attendance_trans.page_title')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif



    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{trans('attendance_trans.date_today')}} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendance.store') }}">
        @csrf
        <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">

            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('students_trans.student_name') }}</th>
                <th>{{ trans('students_trans.email') }}</th>
                <th>{{ trans('students_trans.gender') }}</th>
                <th>{{ trans('students_trans.grade') }}</th>
                <th>{{ trans('students_trans.level') }}</th>
                <th>{{ trans('students_trans.section') }}</th>
                <th>{{ trans('students_trans.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($studentsOfSection as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->name }}</td>
                    <td>{{ $student->grade->name }}</td>
                    <td>{{ $student->level->name}}</td>
                    <td>{{ $student->section->name}}</td>
                    <td>

                        @if(isset($student->attendance()->where('attendance_date',date('Y-m-d'))->first()->student_id))
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $student->id }}]" disabled
                                       {{ $student->attendance->first()->attendance_status == true ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="present">
                                <span class="text-success">{{ trans('attendance_trans.attend') }}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $student->id }}]" disabled
                                       {{ $student->attendance()->first()->attendance_status == false ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">{{ trans('attendance_trans.absent') }}</span>
                            </label>

                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                       value="present">
                                <span class="text-success">{{ trans('attendance_trans.attend') }}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                       value="absent">
                                <span class="text-danger">{{ trans('attendance_trans.absent') }}</span>
                            </label>

                        @endif

                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                        <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                        <input type="hidden" name="level_id" value="{{ $student->level_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="button" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->


@endsection


@section('js')
    @toastr_js
    @toastr_render
@endsection
