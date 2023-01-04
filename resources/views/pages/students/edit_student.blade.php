@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('students_trans.edit_student')}}
@endsection
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('students_trans.edit_student')}}
@endsection
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{route('students.update',$student->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: #3698ac">{{trans('students_trans.personal_info')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input value="{{$student->getTranslation('name','ar')}}" type="text" name="name_ar"  class="form-control">
                                    <input type="hidden" name="id" value="{{$student->id}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input value="{{$student->getTranslation('name','en')}}" class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.email')}} : </label>
                                    <input type="email" value="{{ $student->email }}" name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.password')}} :</label>
                                    <input value="{{ $student->password }}" type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('students_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}" {{$gender->id == $student->gender_id ? 'selected' : ""}}>{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('students_trans.nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($nationalities as $nat)
                                            <option value="{{ $nat->id }}" {{$nat->id == $student->nationality_id ? 'selected' : ""}}>{{ $nat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('students_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($bloods as $bType)
                                            <option value="{{ $bType->id }}" {{$bType->id == $student->blood_id ? 'selected' : ""}}>{{ $bType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('students_trans.date_of_birth')}}  :</label>
                                    <input class="form-control" type="text" value="{{$student->date_of_birth}}" id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: #3698ac">{{trans('students_trans.student_info')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">{{trans('students_trans.grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{$grade->id == $student->grade_id ? 'selected' : ""}}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="level_id">
                                        <option value="{{$student->level_id}}">{{$student->level->name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option value="{{$student->section_id}}"> {{$student->section->name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('students_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == $student->parent_id ? 'selected' : ""}}>{{ $parent->father_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $student->academic_year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                    <button class="btn button btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
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
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('getLevelsByGrade') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="level_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="level_id"]').append('<option selected disabled >{{trans('students_trans.choose')}}...</option>');
                                $('select[name="level_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('select[name="level_id"]').on('change', function () {
                var level_id = $(this).val();
                if (level_id) {
                    $.ajax({
                        url: "{{ URL::to('getSectionsByLevel') }}/" + level_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection