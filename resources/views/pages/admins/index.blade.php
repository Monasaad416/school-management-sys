@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{ trans('admins_trans.admins_list') }}
    @endsection
@endsection


@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('admins_trans.admins_list') }}
    @endsection
<!-- breadcrumb -->
@endsection


@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div>
                <div class="card-body">
                    <a class="button x-small" href="{{route("admins.create")}}">
                        {{ trans('admins_trans.add_admin') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="col-md-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <table id="data_table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('admins_trans.admin_name')}}</th>
                                    <th scope="col">{{trans('admins_trans.joinning_date')}}</th>
                                    <th scope="col">{{trans('admins_trans.gender')}}</th>
                                    <th scope="col">{{trans('admins_trans.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{$loop->iteration}}</th>
                                            <td>{{$admin->name}}</td>
                                            <td>{{Carbon\Carbon::parse($admin->joinning_date)->format('d M ,Y')}}</td>
                                            <td>{{$admin->gender->name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#edit{{$admin->id}}" title={{trans('grades_trans.edit')}}>
                                                    <a href="{{route('admins.edit' , $admin->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#delete{{$admin->id}}" title={{trans('grades_trans.delete')}}>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>


                                        <!-- Delete Modal -->
                                        <form action="{{route('admins.destroy',$admin)}}" method="POST">
                                            <div class="modal fade" id="delete{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('admins_trans.edit')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are your sure you want to delete admin:{{$admin->name}}?</p>

                                                            @csrf
                                                            {{method_field('delete')}}
                                                            <input type="hidden" value="{{$admin->id}}" name="id">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admins_trans.close')}}</button>
                                                                <button type="submit" name="submit" class="btn btn-danger">{{trans('admins_trans.delete')}}</button>
                                                            </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--pagination-->
        <div class="my-3">
            {!! $admins->links() !!}
        </div>  
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="admin_id"]').on('change', function () {
                var admin_id = $(this).val();

                if (admin_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("getLevelsByadmin") }}/" + admin_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            console.log( typeof(data));
                            $('select[name="level_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="level_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection


