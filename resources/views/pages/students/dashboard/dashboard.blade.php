<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{trans('students_trans.page_title')}}</title>
    @include('layouts.head')
</head>

<body>
    <div class="wrapper">
        <!--================================preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--=================================preloader -->

        @include('layouts.main-header')
        @include('layouts.main-sidebar')
         @livewireStyles


        <!--=================================
        Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="my-4">{{trans('admins_trans.welcome')}}  {{Auth::guard('student')->user()->name}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->

            <div class="calendar-main mb-30">
                <div class="row">
                    <div class="col-lg">
                         <livewire:calendar-student/>
                    </div>
                </div>
            </div>
            <!--=================================
            wrapper -->

                <!--=================================
            footer -->

            @include('layouts.footer')
        </div>
        <!-- main content wrapper end-->
    </div>
    <!--=================================footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>
