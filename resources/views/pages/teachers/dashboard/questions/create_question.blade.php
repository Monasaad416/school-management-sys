@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('question_trans.add_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('question_trans.add_question')}}
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
                            <form action="{{ route('t_questions.store') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('question_trans.title')}}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                        <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="option_1">{{trans('question_trans.option_1')}}</label>
                                        <input type="text" name="option_1" class="form-control" id="exampleFormControlTextarea1" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="option_2">{{trans('question_trans.option_2')}}</label>
                                        <input type="text" name="option_2" class="form-control" id="exampleFormControlTextarea1" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="option_3">{{trans('question_trans.option_3')}}</label>
                                        <input type="text" name="option_3" class="form-control" id="exampleFormControlTextarea1" >
                                    </div>
                                        <div class="col-md-6">
                                        <label for="option_4">{{trans('question_trans.option_4')}}</label>
                                        <input type="text" name="option_4" class="form-control" id="exampleFormControlTextarea1" >
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('question_trans.right_answer')}}</label>
                                        <input type="text" name="right_answer" id="input-name" class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="score">{{trans('question_trans.score')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
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
