@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('students_trans.page_title')}}
    @endsection
@endsection
@section('page-header')

@endsection

@section('content')
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive mt-15">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{trans('students_trans.student_name')}}</th>
                                <th scope="col">{{trans('students_trans.email')}}</th>
                                <th scope="col">{{trans('students_trans.gender')}}</th>
                                <th scope="col">{{trans('students_trans.grade')}}</th>
                                <th scope="col">{{trans('students_trans.level')}}</th>
                                <th scope="col">{{trans('students_trans.section')}}</th>
                                <th scope="col">{{trans('quiz_trans.degree')}} %</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($students_teacher as $stud)
                                    @if($stud->quizzes->contains($quiz->id))
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$stud->name}}</td>
                                            <td>{{$stud->email}}</td>
                                            <td>{{$stud->gender->name}}</td>
                                            <td>{{$stud->grade->name}}</td>
                                            <td>{{$stud->level->name}}</td>
                                            <td>{{$stud->section->name}}</td>
                                            <td>{{$stud->quizzes->first()->pivot->result}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <P>
                            <button class="button" type="submit">{{ trans('Students_trans.submit') }}</button>
                        </P> --}}
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
