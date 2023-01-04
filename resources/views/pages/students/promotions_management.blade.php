@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('promot_trans.page_title_m')}}
    @endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('promot_trans.page_title_m')}}</</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-12 mb-30">
               <a href="#" data-toggle="modal" data-target="#demote_all">
                <button type="button" class="btn btn-danger btn-sm  my-3 px-3 py-1">
                    {{trans('promot_trans.demote_all')}}
                </button>
            </a>
            <div class="">
                <div class="">
                    <div class="table-responsive mt-15">
                        <table class="table-resposive table-hover table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;&nbsp;#&nbsp;&nbsp;</th>
                                <th scope="col">{{trans('students_trans.student_name')}}</th>
                                <th scope="col" class="alert alert-danger fs-4">{{trans('promot_trans.last_grade_name')}}</th>
                                <th scope="col" class="alert alert-danger fs-4">{{trans('promot_trans.last_level_name')}}</th>
                                <th scope="col" class="alert alert-danger fs-4">{{trans('promot_trans.last_section_name')}}</th>
                                <th scope="col" class="alert alert-danger fs-4">{{trans('promot_trans.last_academic_year')}}</th>
                                <th scope="col" class="alert alert-success">{{trans('promot_trans.current_grade_name')}}</th>
                                <th scope="col" class="alert alert-success">{{trans('promot_trans.current_level_name')}}</th>
                                <th scope="col" class="alert alert-success">{{trans('promot_trans.current_section_name')}}</th>
                                <th scope="col" class="alert alert-success fs-4">{{trans('promot_trans.current_academic_year')}}</th>
                                <th scope="col" class="alert alert-success">{{trans('students_trans.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($promotions as $promot)
                                    <tr height="70px">
                                            <td scope="row">{{$loop->iteration}}</td>
                                            <td width="300">{{$promot->student->name}}</td>
                                            <td>{{$promot->fromGrade->name}}</td>
                                            <td>{{$promot->fromLevel->name}}</td>
                                            <td>{{$promot->fromSection->name}}</td>
                                            <td>{{$promot->academic_year}}</td>
                                            <td>{{$promot->toGrade->name}}</td>
                                            <td>{{$promot->toLevel->name}}</td>
                                            <td>{{$promot->toSection->name}}</td>
                                            <td>{{$promot->academic_year_new}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm mx-1" data-toggle="modal" data-target="#demote_student{{$promot->id}}">
                                                        {{trans('promot_trans.demote_student')}}
                                                    </button>
                                                    <button type="button" class="button-outline btn-sm mx-1" data-toggle="modal" data-target="#delete{{ $promot->id }}">
                                                        {{trans('promot_trans.graduate_student')}}
                                                    </button>
                                                </div>
                                            </td>
                                            <!--demote one modal-->
                                            <div class="modal fade" id="demote_student{{$promot->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('demote_student',$promot->id)}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="promot_id" value="{{$promot->id}}">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('promot_trans.warning_one')}}</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('students_trans.submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <!--demote all modal-->
    <div class="modal fade" id="demote_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('demote')}}" method="post">
                        @csrf
                        <h5 style="font-family: 'Cairo', sans-serif;">{{trans('promot_trans.warning')}}</h5>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                            <button  class="btn btn-danger">{{trans('students_trans.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('students_trans.add_grade')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('grades.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="ar_name">{{trans('students_trans.stage_name_ar')}}</label>
                    <input type="text" class="form-control" id="ar_name" name="name" aria-describedby="ar_name" placeholder="{{trans('students_trans.stage_name_ar')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('students_trans.stage_name_en')}}</label>
                        <input type="text" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('students_trans.stage_name_en')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('students_trans.notes')}}</label>
                        <input type="text" class="form-control" id="notes" name="notes" aria-describedby="notes" placeholder="{{trans('students_trans.notes')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button type="submit" name="submit" class="btn button">{{trans('students_trans.submit')}}</button>
                    </div>

                </form>
            </div>

        </div>
        </div>
    </div>


@endsection


@section('js')
    @toastr_js
    @toastr_render
@endsection
