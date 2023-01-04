@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="/path/to/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

@section('title')
    {{trans('levels_trans.page_title')}}
@endsection
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-4">
            <h4 class="mb-0"> {{trans('levels_trans.page_title')}}</h4>
        </div>
    </div>
    <div class="row">

        <div class="col-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("/admin/dashboard")}}" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('levels_trans.page_title')}}</li>
            </ol>
        </div>
        <div class="cols-8">
            <!-- Button trigger add modal -->
            <button type="button" class="button" data-toggle="modal" data-target="#add">
                {{trans('levels_trans.add_level')}}
            </button>
            <button type="button" class="button-danger  mx-1" id="btn_delete_all" >
                {{trans('levels_trans.delete_all')}}
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
                          {{-- filter levels start --}}
                          <form action="{{url('levels/filter_levels')}}" method="POST" id="search_form">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <select class="filter_levels" data-style="btn-info" id="filter_levels" name="grade_id" onchange="this.form.submit()">
                                            <option value='' selected disabled>{{trans('levels_trans.search_by_grade')}}</option>
                                            @foreach($grades as  $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                             {{-- filter levels start --}}
                             <div class="table-responsive mt-15">
                                <table id="data_table" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox"
                                                aria-label="Checkbox for following text input"
                                                id="select_all"
                                                name="select_all"
                                                onclick="check_all('selected_box',this)"
                                                >
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">{{trans('levels_trans.name')}}</th>
                                        <th scope="col">{{trans('levels_trans.grade_name')}}</th>
                                        <th scope="col">{{trans('levels_trans.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($searchLevels))
                                            <?php $my_levels = $searchLevels?>
                                        @else
                                            <?php $my_levels = $levels?>
                                        @endif
                                        @foreach($my_levels as $level)
                                            <tr>
                                                <td>
                                                <input type="checkbox"
                                                aria-label="Checkbox for following text input"
                                                value="{{$level->id}}"
                                                class="selected_box"
                                                >
                                                </td>
                                                <td>{{$loop->iteration}}</th>
                                                <td>{{$level->name}}</td>
                                                <td>{{$level->grade->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#edit{{$level->id}}" title={{trans('levels_trans.edit')}}>
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#delete{{$level->id}}" title={{trans('levels_trans.delete')}}>
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('levels_trans.edit')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  action="{{route('levels.update',$level)}}" method="POST">
                                                        @csrf
                                                            {{method_field('patch')}}
                                                            <div class="form-group">
                                                            <label for="ar_name">{{trans('levels_trans.level_name_ar')}}</label>
                                                            <input type="text" value = "{{$level->getTranslation('name','ar')}}" class="form-control" id="ar_name" name="name_ar" aria-describedby="ar_name" placeholder="{{trans('levels_trans.stage_name_ar')}}">
                                                            <input type="hidden" id="id" value="{{$level->id}}" name="id">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="en_name">{{trans('levels_trans.level_name_en')}}</label>
                                                                <input type="text"  value = "{{$level->getTranslation('name','en')}}" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('levels_trans.stage_name_en')}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col">
                                                                    <label for="grade_name" class="mr-sm-2">{{ trans('levels_trans.grade_name') }}:</label>
                                                                    <div class="box">
                                                                        <select class="fancyselect" name="grade_id">
                                                                            <option value="{{ $level->grade->id}}">{{ $level->grade->name}}</option>
                                                                            @foreach ($grades as $key=>$grade)
                                                                                <option value="{{ $grade->id}}">{{ $grade->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="button-close" data-dismiss="modal">{{trans('levels_trans.close')}}</button>
                                                                <button type="submit" name="submit" class="button">{{trans('levels_trans.submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                </div>
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('levels_trans.edit')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are your sure you want to delete {{$level->name}}?</p>
                                                        <form  action="{{route('levels.destroy',$level)}}" method="POST">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                            <input type="hidden" id="id" value="{{$level->id}}" name="id">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('levels_trans.close')}}</button>
                                                                <button type="submit" name="submit" class="btn btn-danger">{{trans('levels_trans.delete')}}</button>
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
    <style>
        .modal-dialog {
            max-width: 800px !important;
        }
    </style>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('levels_trans.add_level')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('levels.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="list_levels">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">{{ trans('levels_trans.level_name_ar') }}:</label>
                                            <input class="form-control" type="text" name="name_ar"  />
                                        </div>
                                        <div class="col">
                                            <label for="name_en" class="mr-sm-2">{{ trans('levels_trans.level_name_en') }}:</label>
                                            <input class="form-control" type="text" name="name_en"  />
                                        </div>
                                        <div class="col">
                                            <label for="grade_name" class="mr-sm-2">{{ trans('levels_trans.grade_name') }}:</label>
                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id}}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="repeat"
                                                class="mr-sm-2">{{ trans('levels_trans.actions') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('levels_trans.delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('levels_trans.add_level') }}"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="button-close" data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                <button type="submit" class="button">{{ trans('grades_trans.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </div>




    <!-- Delete All Rows (chech_all) -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('levels_trans.delete_all')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p class="btn btn-danger">{{trans('levels_trans.delete_all_q')}}</p>
               <form action="{{url('levels/delete_all')}}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" id="delete_all_id" name="delete_all_id" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('levels_trans.close')}}</button>
                        <button type="submit" name="submit" class="btn btn-danger">{{trans('levels_trans.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        
    </div>


@endsection


@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(function() {
            $("#btn_delete_all").click(function(){
                var selected = new Array();
                $("#data_table input[type=checkbox]:checked").each(function(){
                    selected.push(this.value);
                })

                if(selected.length > 0){
                    $("#delete_all").modal("show");
                    $('input[id ="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
