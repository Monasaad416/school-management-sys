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
{{trans('question_trans.questions_list')}} : <span class="text-danger">{{$quiz->name}}</span>
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
                                <h4 class="py-4">{{trans('question_trans.questions_list')}} : <span class="text-danger">{{$quiz->name}}</span></h4>
                                <a href="{{route('t_questions.show',$quiz->id)}}" class="button btn-sm" role="button" aria-pressed="true">{{trans('question_trans.add_question')}}</a><br><br>
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
                                                <td>
                                                    {{$question->option_1}}<br>
                                                    {{$question->option_2}}<br>
                                                    {{$question->option_3}}<br>
                                                    {{$question->option_4}}<br>
                                                </td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quiz->name}}</td>
                                                <td>
                                                    <a href="{{route('t_questions.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.teachers.dashboard.questions.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--pagination-->
        <div class="my-3">
            {!! $questions->links() !!}
        </div>  
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection