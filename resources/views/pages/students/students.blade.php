@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('students_trans.page_title')}}
    @endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="mr-auto p-2">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="/dashboard" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('students_trans.page_title')}}</</li>
                </ol>
            </div>
            <div class="p-2">
                <!-- Button trigger add modal -->
                <button type="button" class="button btn-sm mx-1">
                    <a href={{route('students.create')}}>{{trans('students_trans.add_student')}}</a>
                </button>
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
                                <th scope="col">{{trans('students_trans.email')}}</th>
                                <th scope="col">{{trans('students_trans.gender')}}</th>
                                <th scope="col">{{trans('students_trans.grade')}}</th>
                                <th scope="col">{{trans('students_trans.level')}}</th>
                                <th scope="col">{{trans('students_trans.section')}}</th>
                                <th scope="col">{{trans('students_trans.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $stud)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$stud->name}}</td>
                                        <td>{{$stud->email}}</td>
                                        <td>{{$stud->gender->name}}</td>
                                        <td>{{$stud->grade->name}}</td>
                                        <td>{{$stud->level->name}}</td>
                                        <td>{{$stud->section->name}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="button-outline dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{trans('students_trans.actions')}}
                                                </button>
                                                <form method="POST" action=""></form>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('students.edit',$stud->id)}}"><i class="fa fa-pencil mx-2" aria-hidden="true"></i>{{trans('students_trans.edit_student')}}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$stud->id}}"><i class="fa fa-trash-o mx-2" aria-hidden="true"></i>{{trans('students_trans.delete_student')}}</a>

                                                    <a class="dropdown-item" href="{{route('students.show',$stud->id)}}"><i class="fa fa-eye mx-2" aria-hidden="true"></i>{{trans('students_trans.show_student')}}</a>
                                                    <a class="dropdown-item" href="{{route('invoices.get',$stud->id)}}"><i class="fa fa-list mx-2" aria-hidden="true"></i>{{trans('fees_trans.invoice')}}</a>
                                                    <a class="dropdown-item" href="{{route('invoices.show',$stud->id)}}"><i class="fa fa-plus mx-2" aria-hidden="true"></i>{{trans('fees_trans.add_invoice_item')}}</a>
                                                    <a class="dropdown-item" href="{{route('receipt_students.show',$stud->id)}}"><i class="fa fa-money mx-2" aria-hidden="true"></i>{{trans('fees_trans.cash_receipt')}}</a>
                                                    <a class="dropdown-item" href="{{route('processing_fees.show',$stud->id)}}"><i class="fa fa-backward mx-2" aria-hidden="true"></i>{{trans('fees_trans.fees_exclusion')}}</a>
                                                    <a class="dropdown-item" href="{{route('payments_fund.show',$stud->id)}}"><i class="fa fa-money mx-2" aria-hidden="true"></i>{{trans('fees_trans.payment_voucher')}}</a>
                                                </div>
                                            </div>
                                        </td>

                                        <!--delete modal-->
                                        <div class="modal fade" id="delete{{$stud->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('students_trans.delete_student')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('students.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="id" value="{{$stud->id}}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('students_trans.warning')}}</h5>
                                                            <input type="text" readonly value="{{$stud->name}}" class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                                                                <button  class="btn btn-danger">{{trans('students_trans.submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <!-- Add Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('students_trans.add_grade')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('grades.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="ar_name">{{trans('students_trans.stage_name_ar')}}</label>
                    <input type="text" class="form-control" id="ar_name" name="name" aria-describedby="ar_name" placeholder="{{trans('students_trans.stage_name_ar')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('students_trans.stage_name_en')}}</label>
                        <input type="text" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('students_trans.stage_name_en')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('students_trans.notes')}}</label>
                        <input type="text" class="form-control" id="notes" name="notes" aria-describedby="notes" placeholder="{{trans('students_trans.notes')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button type="submit" name="submit" class="btn button">{{trans('students_trans.submit')}}</button>
                    </div>

                </form>
            </div>

        </div>
        </div>
    </div>


    <!--pagination-->
    <div class="my-3">
        {!! $students->links() !!}
    </div>

@endsection


@section('js')
    @toastr_js
    @toastr_render
@endsection
