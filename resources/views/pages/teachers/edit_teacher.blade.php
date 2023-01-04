@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('techs_trans.edit_teacher') }}
@endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('techs_trans.edit_teacher') }}
@endsection
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
   
                 
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('teachers.update',$teacher)}}" method="POST">
                                @csrf
                                {{method_field('patch')}}
                                <div class="form-row">
                                    <div class="col">
                                        <input type="hidden" name="id" value={{$teacher->id}}>
                                        <label>{{trans('techs_trans.email')}}</label>
                                        <input type="email" name="email" class="form-control" value={{$teacher->email}}>
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
                                        <input type="text" name="name_ar" class="form-control" value={{$teacher->getTranslation('name', 'ar')}}>
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('techs_trans.teacher_name_en')}}</label>
                                        <input type="text" name="name_en" class="form-control" value={{$teacher->getTranslation('name', 'ar')}}>
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
  
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('techs_trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization_id" >
                                            <option selected value="{{$teacher->specialization_id}}">{{$teacher->specialization->name}}</option>
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
                                            <option selected value="{{$teacher->gender_id}}">{{$teacher->gender->name}}</option>
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
                                            <input class="form-control" type="text"  id="datepicker-action" name="joinning_date" data-date-format="yyyy-mm-dd"  value={{($teacher->joinning_date)}} required>
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
                                            id="exampleFormControlTextarea1" rows="4">{{$teacher->address}}</textarea>
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
