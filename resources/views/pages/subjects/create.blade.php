@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('subjects_trans.add_subject')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('subjects_trans.add_subject')}}
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
                            <form action="{{route('subjects.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> {{trans('subjects_trans.subject_name_ar')}} </label>
                                        <input type="text" name="name_ar" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('subjects_trans.subject_name_en')}} </label>
                                        <input type="text" name="name_en" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('students_trans.grade')}} </label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                            <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{trans('students_trans.level')}}</label>
                                        <select name="level_id" class="custom-select">

                                        </select>
                                    </div>


                                    <div class="form-group col">
                                        <label for="inputState">{{trans('techs_trans.teacher_name')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                            <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
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
    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
