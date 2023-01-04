@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
  {{trans('quiz_trans.edit_quiz')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('quiz_trans.edit_quiz')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                                <form action="{{route('quizzes.update',$quiz->id)}}" method="post">
                                    {{ method_field('patch') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('quiz_trans.quiz_name_ar')}}</label>
                                        <input type="text" name="name_ar" value="{{ $quiz->getTranslation('name', 'ar') }}" class="form-control">
                                        <input type="hidden" name="id" value="{{$quiz->id}}">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{trans('quiz_trans.quiz_name_en')}}</label>
                                        <input type="text" name="name_en" value="{{ $quiz->getTranslation('name', 'en') }}" class="form-control">
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
                                                    <option  value="{{ $subject->id }}"  {{$subject->id == $quiz->subject_id ? "selected":""}}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('techs_trans.teacher_name')}}  : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}"  {{$teacher->id == $quiz->teacher_id ? "selected":""}}>{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('students_trans.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}"  {{$grade->id == $quiz->grade_id ? "selected":""}}>{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="level_id">
                                                <option value="{{$quiz->level_id}}">{{$quiz->level->name}}</option> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option value="{{$quiz->section_id}}">{{$quiz->section->name}}</option> 
                                            </select>
                                        </div>
                                    </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
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
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
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
