@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
  {{trans('quiz_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('quiz_trans.page_title')}}
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
                                <a href="{{route('quizzes.create')}}" class="button btn-sm my-4" role="button" aria-pressed="true">{{trans('quiz_trans.add_quiz')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('quiz_trans.quiz')}}</th>
                                            <th>{{trans('quiz_trans.term')}}</th>
                                            <th>{{trans('techs_trans.teacher_name')}}</th>
                                            <th>{{trans('students_trans.grade')}}</th>
                                            <th>{{trans('students_trans.level')}}</th>
                                            <th>{{trans('students_trans.section')}}</th>
                                            <th>{{trans('students_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quiz)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>{{$quiz->term}}</td>
                                                <td>{{$quiz->teacher->name}}</td>
                                                <td>{{$quiz->grade->name}}</td>
                                                <td>{{$quiz->level->name}}</td>
                                                <td>{{$quiz->section->name}}</td>
                                                <td>
                                                    <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title={{trans('grades_trans.edit')}}><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_quiz{{ $quiz->id }}" title="{{trans('quiz_trans.delete_quiz')}}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete_quiz{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="quizpleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('quizzes.destroy',$quiz->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="quizpleModalLabel"> {{trans('quiz_trans.delete_quiz')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('quiz_trans.warning') }} {{$quiz->name}}</p>
                                                                <input type="hidden" name="quiz" value="{{$quiz->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('students_trans.close') }}</button>
                                                                    <button type="submit" class="btn btn-danger">{{ trans('students_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
            {!! $quizzes->links() !!}
        </div> --}}

    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
