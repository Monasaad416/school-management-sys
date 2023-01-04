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

                    @include('inc.errors')

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                                <form action="{{route('t_quizzes.update',$quiz->id)}}" method="post">
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

                                    <div class="form-row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="grade_id">{{trans('students_trans.grade')}} : <span class="text-danger">*</span></label>
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
                                                <label for="level_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
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
                                        
                                    </div>
                                    <button class="btn button btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
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

@endsection
