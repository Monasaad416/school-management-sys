@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('admins_trans.edit_admin') }}
@endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('admins_trans.edit_admin') }}
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
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('admins.store')}}" method="POST">
                             @csrf
                            <div class="form-row">
                                <input type="hidden" name="admin_id"  value={{$admin->id}}>
                                <div class="col-md-6">
                                    <label>{{trans('techs_trans.email')}}</label>
                                    <input type="email" name="email" value = "{{$admin->email}}" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>{{trans('techs_trans.password')}}</label>
                                    <input type="password" name="password"  class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>{{trans('admins_trans.admin_name_ar')}}</label>
                                    <input type="text" name="name_ar" value = "{{$admin->getTranslation('name','ar')}}"  class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="title">{{trans('admins_trans.admin_name_en')}}</label>
                                    <input type="text" name="name_en" value = "{{$admin->getTranslation('name','en')}}"  class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <label>{{trans('techs_trans.joinning_date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  value = "{{$admin->joinning_date}}" id="datepicker-action" name="joinning_date" data-date-format="yyyy-mm-dd"  >
                                    </div>
                                    @error('joinning_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <br>

                            <div class="form-row">

                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('techs_trans.editress')}}</label>
                                <textarea class="form-control" name="address"
                                          id="exampleFormControlTextarea1" rows="4">{{$admin->address}}</textarea>
                                @error('editress')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="button btn-lg pull-right" type="submit">{{trans('techs_trans.save')}}</button>
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
