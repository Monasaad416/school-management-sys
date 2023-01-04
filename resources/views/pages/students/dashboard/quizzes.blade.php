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
                                <div class="table-responsive">
                                              <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{trans('subjects_trans.subject')}}</th>
                                            <th>{{trans('quiz_trans.quiz')}}</th>
                                            <th>{{trans('quiz_trans.enter')}}/{{trans('quiz_trans.degree')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quiz)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quiz->subject->name}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>
                                                    {{-- dispaly start button only for auth user ,who is student & dont solve it before --}}
                                                    {{-- @php
                                                        if($student->quizzes->contains($quiz->id)){
                                                            $pivotRow = $student->quizzes()->where('quiz_id', $quiz->id)->first();
                                                            $status = $pivotRow->pivot->status;
                                                        }
                                                    @endphp --}}
                                                        @if(! $student->quizzes->contains($quiz->id))
                                                            <a href="{{route('s_quizzes.show',$quiz->id)}}"
                                                                class="button btn-sm" role="button"
                                                                aria-pressed="true" >
                                                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                        <span class="text-danger">submitted</span>
                                        
                                                        
                                                        @endif
                                                
                                             
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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
