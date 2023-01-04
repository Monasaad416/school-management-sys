@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('quiz_trans.add_quiz')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('quiz_trans.add_quiz')}}
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
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('t_quizzes.store')}}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('quiz_trans.quiz_name_ar')}}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{trans('quiz_trans.quiz_name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('subjects_trans.subject')}}  : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($subjects as $subject)
                                                    <option  value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('techs_trans.teacher_name')}}  : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('students_trans.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="level_id">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                {{-- <div class="form-row">
                                    <div class="form-group col">
                                        <label for="academic_year">{{trans('students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{$year}}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </div> --}}
                                <button class="button float-right" type="submit">{{trans('students_trans.submit')}}</button>
                            </form>
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
    <script>
    //add levels by selecting grade
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/teacher/dashboard/t_getLevelsByGrade") }}/" + grade_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="level_id"]').empty();
                         $('select[name="level_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {

                            $('select[name="level_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
//add sections by selecting level
    $(document).ready(function () {
        $('select[name="level_id"]').on('change', function () {
            var level_id = $(this).val();
            console.log(level_id);
            if (level_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/teacher/dashboard/t_getSectionsByLevel") }}/" + level_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        console.log( "type", typeof(data));
                        $('select[name="section_id"]').empty();
                         $('select[name="section_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });

            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
