<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')
         @livewireStyles

        <!--=================================
 Main content -->
        <!-- main-content -->
        <style>
            /*----  Main Style  ----*/
            #cards_landscape_wrap-2{
            text-align: center;
            background: #F7F7F7;
            }
            #cards_landscape_wrap-2 .container{
            padding-top: 80px;
            padding-bottom: 100px;
            }
            #cards_landscape_wrap-2 a{
            text-decoration: none;
            outline: none;
            }
            #cards_landscape_wrap-2 .card-flyer {
            border-radius: 5px;
            }
            #cards_landscape_wrap-2 .card-flyer .image-box{
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
            border-radius: 5px;
            }
            #cards_landscape_wrap-2 .card-flyer .image-box img{
            -webkit-transition:all .9s ease;
            -moz-transition:all .9s ease;
            -o-transition:all .9s ease;
            -ms-transition:all .9s ease;
            width: 50%;
            height: 200px;
            }
            #cards_landscape_wrap-2 .card-flyer:hover .image-box img{
            opacity: 0.7;
            -webkit-transform:scale(1.15);
            -moz-transform:scale(1.15);
            -ms-transform:scale(1.15);
            -o-transform:scale(1.15);
            transform:scale(1.15);
            }
            #cards_landscape_wrap-2 .card-flyer .text-box{
            text-align: center;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box .text-container{
            padding: 30px 18px;
            }
            #cards_landscape_wrap-2 .card-flyer{
            background: #FFFFFF;
            margin-top: 50px;
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
            }
            #cards_landscape_wrap-2 .card-flyer:hover{
            background: #fff;
            box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            margin-top: 50px;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box p{
            margin-top: 10px;
            margin-bottom: 0px;
            padding-bottom: 0px;
            font-size: 14px;
            letter-spacing: 1px;
            color: #000000;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box h6{
            margin-top: 0px;
            margin-bottom: 4px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            font-family: 'Roboto Black', sans-serif;
            letter-spacing: 1px;
            color: #00acc1;
            }

        </style>
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="my-4">{{trans('admins_trans.welcome')}} {{$parent->father_name}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Topic Cards -->
    <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class="row">
            @foreach($sons as $son)
                 <div class="col-lg-4">
                    <a href="">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="{{asset('assets/images/student.jfif')}}" width="200" alt="" />
                                </div>

                                <div class="text-container">
                                   <h6>{{trans('students_trans.student_info')}}</h6>
                                   <p>{{trans('students_trans.student_name')}}: {{$son->name}}</p>
                                   <p>{{trans('students_trans.grade')}}: {{$son->grade->name}}</p>
                                   <p>{{trans('students_trans.level')}}: {{$son->level->name}}</p>
                                   <p>{{trans('students_trans.section')}}: {{$son->section->name}}</p>
                                   <p>{{$son->name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>



            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>
