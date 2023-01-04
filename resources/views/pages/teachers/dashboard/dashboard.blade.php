<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{trans('techs_trans.teacher_panel')}}</title>
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--preloader -->
    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')
         @livewireStyles

        <!--Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="my-4">{{trans('admins_trans.welcome')}} {{Auth::guard('teacher')->user()->name}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-graduation-cap highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('admins_trans.students_count')}}</p>
                                    <h4>{{$students_teacher}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-eye mr-1" aria-hidden="true"></i>
                                <a href="{{route('t_students')}}">{{trans('admins_trans.display_data')}}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-home highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                            <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('admins_trans.sections_count')}}</p>
                                    <h4>{{$sections_teacher_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-eye mr-1" aria-hidden="true"></i>
                                <a href="{{route('t_sections')}}">{{trans('admins_trans.display_data')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Orders Status widgets-->

            <div class="calendar-main mb-30">
                <div class="row">
                    <div class="col-lg">
                             <livewire:calendar />
                    </div>
                </div>
            </div>
            <!--wrapper -->

            <!--footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>
