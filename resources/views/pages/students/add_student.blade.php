@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('sidebar_trans.add_student')}}
@endsection
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('sidebar_trans.add_student')}}
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

                <form method="post" action="{{ route('students.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: #3698ac;">{{trans('students_trans.personal_info')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" value="{{old('name_en')}}" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.email')}} : </label>
                                    <input type="email"  name="email" value="{{old('email')}}" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('students_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id" value="{{old('gender_id')}}">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('students_trans.nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id" value="{{old('nationality_id')}}">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('students_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id" value="{{old('blood_id')}}">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($bloods as $bType)
                                            <option value="{{ $bType->id }}">{{ $bType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('students_trans.date_of_birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="date_of_birth" value="{{old('date_of_birth')}}"data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: #3698ac;">{{trans('students_trans.student_info')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="level_id">{{trans('students_trans.level')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="level_id" value="{{old('level_id')}}">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id" value="{{old('section_id')}}">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('students_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id" value="{{old('parent_id')}}">
                                        <option selected disabled>{{trans('students_trans.choose')}}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->father_name }}</option>
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
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('students_trans.attachments')}} : </label>
                                <input type="file"  accept="images/*" name="images[]" class="form-control" multiple>
                            </div>
                        </div>
                    <button class="button btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
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

@endsection


