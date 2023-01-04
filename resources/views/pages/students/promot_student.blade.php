@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('sidebar_trans.promotions')}}
@endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('sidebar_trans.promotions')}}
@endsection
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h6 style="color: #3698ac;font-family: Cairo">{{trans('promot_trans.old_grade')}}</h6><br>

                    <form method="post" action="{{route('promotions.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('students_trans.grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option selected disabled>{{trans('Parent_trans.choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="level_id">{{trans('students_trans.levels')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="level_id" required>

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="academic_year">{{trans('students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <br><h6 style="color: #3698ac;font-family: Cairo">{{trans('promot_trans.new_grade')}}</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('students_trans.grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id_new" >
                                    <option selected disabled>{{trans('parent_trans.choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="level_id">{{trans('students_trans.levels')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="level_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">:{{trans('students_trans.section')}} </label>
                                <select class="custom-select mr-sm-2" name="section_id_new" >

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="academic_year">{{trans('students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year_new">
                                    <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="button float-right">{{trans('promot_trans.submit')}}</button>
                    </form>

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
    //add levels by selecting grade
    $(document).ready(function () {
        $('select[name="grade_id_new"]').on('change', function () {
            var grade_id_new = $(this).val();
            if (grade_id_new) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("getLevelsByGrade") }}/" + grade_id_new,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="level_id_new"]').empty();
                         $('select[name="level_id_new"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {

                            $('select[name="level_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('select[name="level_id_new"]').on('change', function () {
            var level_id_new = $(this).val();
            console.log(level_id_new);
            if (level_id_new) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("getSectionsByLevel") }}/" + level_id_new,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        console.log( "type", typeof(data));
                        $('select[name="section_id_new"]').empty();
                         $('select[name="section_id_new"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
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
