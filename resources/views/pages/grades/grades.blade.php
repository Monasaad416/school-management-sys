@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('grades_trans.page_title')}}
    @endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="row my-4 d-flex">
        <div class="mr-auto p-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('grades_trans.page_title')}}</</li>
            </ol>
        </div>
        <div class="p-2">
            <!-- Button trigger add modal -->
            <button type="button" class="button btn-sm mx-1" data-toggle="modal" data-target="#add">
                {{trans('grades_trans.add_grade')}}
            </button>
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
                                <th scope="col">{{trans('grades_trans.name')}}</th>
                                <th scope="col">{{trans('grades_trans.notes')}}</th>
                                <th scope="col">{{trans('grades_trans.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $grade)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$grade->name}}</td>
                                        <td>{{$grade->notes}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$grade->id}}" title="{{trans('grades_trans.edit')}}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$grade->id}}" title="{{trans('grades_trans.delete')}}">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{trans('grades_trans.edit')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form  action="{{route('grades.update',$grade)}}" method="POST">
                                                @csrf
                                                    {{method_field('patch')}}

                                                    <div class="form-group">
                                                    <label for="ar_name">{{trans('grades_trans.stage_name_ar')}}</label>
                                                    <input type="text" value = "{{$grade->getTranslation('name','ar')}}" class="form-control" id="ar_name" name="name" aria-describedby="ar_name" placeholder="{{trans('grades_trans.stage_name_ar')}}">
                                                    <input type="hidden" id="id" value="{{$grade->id}}" name="id">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="en_name">{{trans('grades_trans.stage_name_en')}}</label>
                                                        <input type="text"  value = "{{$grade->getTranslation('name','en')}}" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('grades_trans.stage_name_en')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="en_name">{{trans('grades_trans.notes')}}</label>
                                                        <input type="text"  value = "{{$grade->notes}}" class="form-control" id="notes" name="notes" aria-describedby="notes" placeholder="{{trans('grades_trans.notes')}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="button-close" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
                                                        <button type="submit" name="submit" class="button">{{trans('grades_trans.submit')}}</button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{trans('grades_trans.edit')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are your sure you want to delete {{$grade->name}}?</p>
                                                <form  action="{{route('grades.destroy',$grade)}}" method="POST">
                                                    @csrf
                                                    {{method_field('delete')}}
                                                    <input type="hidden" id="id" value="{{$grade->id}}" name="id">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
                                                        <button type="submit" name="submit" class="btn btn-danger">{{trans('grades_trans.delete')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
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
            <h5 class="modal-title" id="exampleModalLabel">{{trans('grades_trans.add_grade')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('grades.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="ar_name">{{trans('grades_trans.stage_name_ar')}}</label>
                    <input type="text" class="form-control" id="ar_name" name="name" aria-describedby="ar_name" placeholder="{{trans('grades_trans.stage_name_ar')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('grades_trans.stage_name_en')}}</label>
                        <input type="text" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('grades_trans.stage_name_en')}}">
                    </div>
                    <div class="form-group">
                        <label for="en_name">{{trans('grades_trans.notes')}}</label>
                        <input type="text" class="form-control" id="notes" name="notes" aria-describedby="notes" placeholder="{{trans('grades_trans.notes')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-close" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
                        <button type="submit" name="submit" class="button">{{trans('grades_trans.submit')}}</button>
                    </div>

                </form>
            </div>

        </div>
        </div>
        
    <!--pagination-->
    <div class="my-3">
        {!! $grades->links() !!}
    </div>

    </div>


@endsection


@section('js')
    @toastr_js
    @toastr_render
@endsection
