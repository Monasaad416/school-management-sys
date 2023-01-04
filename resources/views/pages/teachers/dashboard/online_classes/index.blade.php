@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('online_class_trans.page_title')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('online_class_trans.page_title')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <h5 class="my-4 mx-3" > {{trans('techs_trans.teacher_name')}} :<span class="text-danger"> {{$teacher->name}}</span></h5>
                            <div class="card-body">
                                <a href="{{route('t_online_classes.create')}}" class="button" role="button"
                                   aria-pressed="true">{{trans('online_class_trans.add_online_class')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('students_trans.grade')}}</th>
                                            <th>{{trans('students_trans.level')}}</th>
                                            <th>{{trans('students_trans.section')}}</th>
                                            <th>{{trans('online_class_trans.online_class_title')}}</th>
                                            <th>{{trans('online_class_trans.starting_date')}}</th>
                                            <th>{{trans('online_class_trans.duration')}}</th>
                                            <th>{{trans('online_class_trans.class_link')}}</th>
                                            <th>{{trans('students_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_class)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$online_class->grade->name}}</td>
                                                <td>{{$online_class->level->name }}</td>
                                                <td>{{$online_class->section->name}}</td>
                                                <td>{{$online_class->topic}}</td>
                                                <td>{{$online_class->start_at}}</td>
                                                <td>{{$online_class->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_class->join_url}}" target="_blank"> {{trans('online_class_trans.join_now')}}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_class{{$online_class->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--pagination-->
        <div class="my-3">
            {!! $online_classes->links() !!}
        </div>  
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
