
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('books_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('books_trans.page_title')}}
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
                            <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('books_trans.book_name')}}</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>

                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('students_trans.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="level_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="level_id">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="teacher_id">{{trans('techs_trans.teacher_name')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="file_name">{{trans('Students_trans.attachments')}} : <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf" name="file_name" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="button float-right" type="submit">{{trans('students_trans.submit')}}</button>
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
