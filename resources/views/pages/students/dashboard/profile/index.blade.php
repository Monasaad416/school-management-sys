@extends('layouts.master')
@section('css')

@section('title')
{{trans('techs_trans.profile')}}
@endsection
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('techs_trans.profile')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('techs_trans.profile')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <style>
                    .main-body {
                        padding: 15px;
                    }
                    .card {
                        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
                    }

                    .card {
                        position: relative;
                        display: flex;
                        flex-direction: column;
                        min-width: 0;
                        word-wrap: break-word;
                        background-color: #fff;
                        background-clip: border-box;
                        border: 0 solid rgba(0,0,0,.125);
                        border-radius: .25rem;
                    }

                    .card-body {
                        flex: 1 1 auto;
                        min-height: 1px;
                        padding: 1rem;
                    }

                    .gutters-sm {
                        margin-right: -8px;
                        margin-left: -8px;
                    }

                    .gutters-sm>.col, .gutters-sm>[class*=col-] {
                        padding-right: 8px;
                        padding-left: 8px;
                    }
                    .mb-3, .my-3 {
                        margin-bottom: 1rem!important;
                    }

                    .bg-gray-300 {
                        background-color: #e2e8f0;
                    }
                    .h-100 {
                        height: 100%!important;
                    }
                    .shadow-none {
                        box-shadow: none!important;
                    }
                </style>

                <div class="container">
                    <div class="main-body">

                          <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                      <h4>{{$student->name}}</h4>
                                      <p class="text-secondary mb-1">{{$student->email}}</p>
                                      <p class="text-muted font-size$inf-sm">{{$student->address}}</p>

                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="col-md-8">
                              <div class="card mb-3">
                                <div class="card-body">
                                    <form action="{{route('student_profile.update',$student->id)}}" method="post">
                                        @csrf
                                         {{ method_field('patch') }}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('techs_trans.teacher_name_ar')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="text" name="name_ar"
                                                        value="{{ $student->getTranslation('name', 'ar') }}"
                                                        class="form-control">
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('techs_trans.teacher_name_ar')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="text" name="name_en"
                                                        value="{{ $student->getTranslation('name', 'en') }}"
                                                        class="form-control">
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('techs_trans.password')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <input type="password" id="password" class="form-control" name="password">
                                                </p><br><br>
                                                <input type="checkbox" class="form-check-input" onclick="show_password()"
                                                    id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">{{trans('techs_trans.show_password')}}</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="button">{{trans('techs_trans.edit_info')}}</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>

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
        function show_password()
        {
            let password = document.getElementById('password');
            if (password.type === "password"){
                password.type = "text";
                console.log(password.type )
            }else {
                password.type = "password";
            }
        }
    </script>
@endsection
