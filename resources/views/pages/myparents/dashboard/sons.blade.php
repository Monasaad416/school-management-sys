@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('parent_trans.sons')}}
    @endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="/dashboard" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('students_trans.page_title')}}</</li>
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
                                <th scope="col">{{trans('students_trans.results')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($sons as $son)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$son->name}}</td>
                                        <td>{{$son->email}}</td>
                                        <td>{{$son->gender->name}}</td>
                                        <td>{{$son->grade->name}}</td>
                                        <td>{{$son->level->name}}</td>
                                        <td>{{$son->section->name}}</td>
                                        <td>


                                            <a href="{{route('sons.results',$son->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>
                                        </td>
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

 <!--footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')


@section('js')
    @toastr_js
    @toastr_render
@endsection
