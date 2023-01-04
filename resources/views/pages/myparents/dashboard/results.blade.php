@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('students_trans.results')}}
    @endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col">
                 <li>
                <a href="">
                <i class="ti-home"></i>
                
                </a>
            </li>
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('myparent.dashboard')}}" class="default-color">{{trans('parent_trans.parent_dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('students_trans.results')}}</</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive mt-15">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{trans('students_trans.student_name')}}</th>
                                <th scope="col">{{trans('quiz_trans.quiz')}}</th>
                                <th scope="col">{{trans('subjects_trans.subject')}}</th>
                                <th scope="col">{{trans('quiz_trans.degree')}} %</th>
                            </tr>
                            </thead>
                            <tbody>
                   
                                @foreach($results as $result)
                                    
                                    @if($student->quizzes->contains($result->pivot->quiz_id))
                                       <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$student->name}}</td>
                                            <td>{{$result->name}}</td>
                                            <td>{{$result->subject->name}}</td>
                                            <td>{{$result->pivot->result}}</td>
                                        </tr>
                                    @else
                                    <tr><td colspan="5">No submitted quizzes for your son</td></tr>
                                    @endif
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

     <!--footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')



@endsection


@section('js')
    @toastr_js
    @toastr_render
@endsection
