@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('question_trans.edit_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('question_trans.edit_question')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>

                            @include('inc.errors')

                            <form action="{{ route('t_questions.update', $question->id ) }}" method="post" autocomplete="off">
                                {{ method_field('patch') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('question_trans.title')}}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative" value="{{$question->title}}" autofocus>
                                        <input type="hidden" value="{{$question->id}}" name="question_id">
                                        <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="option_1">{{trans('question_trans.option_1')}}</label>
                                        <input type="text" name="option_1" class="form-control" value="{{$question->option_1}}"  id="exampleFormControlTextarea1" >
                                        @if($errors->has('firstname'))
                                            <div class="error">{{ $errors->first('option_1') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="option_2">{{trans('question_trans.option_2')}}</label>
                                        <input type="text" name="option_2" class="form-control" value="{{$question->option_2}}"  id="exampleFormControlTextarea1" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="option_3">{{trans('question_trans.option_3')}}</label>
                                        <input type="text" name="option_3" class="form-control" value="{{$question->option_3}}" id="exampleFormControlTextarea1" >
                                    </div>
                                    <div class="col-md-6">
                                    <label for="option_4">{{trans('question_trans.option_4')}}</label>
                                    <input type="text" name="option_4" class="form-control" value="{{$question->option_4}}" id="exampleFormControlTextarea1" >
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('question_trans.right_answer')}}</label>
                                        <input type="text" name="right_answer" value="{{$question->right_answer}}"  id="input-name" class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="score">{{trans('question_trans.score')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option value="5" {{$question->score == 5 ? 'selected':'' }} >5</option>
                                                <option value="10" {{$question->score == 10 ? 'selected':'' }} >10</option>
                                                <option value="15" {{$question->score == 15 ? 'selected':'' }} >15</option>
                                                <option value="20" {{$question->score == 20 ? 'selected':'' }} >20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
