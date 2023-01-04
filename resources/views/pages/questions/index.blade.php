@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('question_trans.questions_list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('question_trans.questions_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('questions.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('question_trans.add_question')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('question_trans.question')}}</th>
                                            <th scope="col">{{trans('question_trans.answers')}}</th>
                                            <th scope="col">{{trans('question_trans.right_answer')}}</th>
                                            <th scope="col">{{trans('question_trans.score')}}</th>
                                            <th scope="col">{{trans('quiz_trans.quiz')}}</th>
                                            <th scope="col">{{trans('students_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quiz->name}}</td>
                                                <td>
                                                    <a href="{{route('questions.edit',$question->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title={{trans('grades_trans.edit')}}><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_question{{ $question->id }}" title="{{trans('question_trans.delete_question')}}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.Questions.destroy')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!--pagination-->
        <div class="my-3">
            {!! $questions->links() !!}
        </div> --}}

    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
