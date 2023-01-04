@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('techs_trans.add_teacher') }}
@endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('techs_trans.add_teacher') }}
@endsection
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
                            <form action="{{route('teachers.store')}}" method="POST">
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label>{{trans('techs_trans.email')}}</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>{{trans('techs_trans.password')}}</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label>{{trans('techs_trans.teacher_name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('techs_trans.teacher_name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('techs_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                        <option selected disabled>{{trans('techs_trans.select')}}...</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('techs_trans.gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('techs_trans.select')}}...</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label>{{trans('techs_trans.joinning_date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action" name="joinning_date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('joinning_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('techs_trans.address')}}</label>
                                <textarea class="form-control" name="address"
                                          id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="button float-right" type="submit">{{trans('techs_trans.save')}}</button>
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
