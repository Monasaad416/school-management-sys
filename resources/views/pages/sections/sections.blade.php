@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('sec_trans.page_title') }}
@endsection
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('sec_trans.page_title') }}
@endsection
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="mr-auto p-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="default-color">{{trans('sidebar_trans.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sec_trans.page_title')}}</</li>
            </ol>
        </div>
        <div class="p-2">
            <!-- Button trigger add modal -->
            <a class="button x-small" href="#" data-toggle="modal" data-target="#add">{{trans('sec_trans.add_section')}}</a>
        </div>
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

        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="accordion gray plus-icon round">
                    @foreach ($grades as $grade)
                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{ $grade->name }}</a>
                            <div class="acd-des">
                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div>
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>{{ trans('sec_trans.name') }}</th>
                                                            <th>{{ trans('sec_trans.grade_name') }}</th>
                                                            <th>{{ trans('sec_trans.level_name') }}</th>
                                                            <th>{{ trans('sec_trans.status') }}</th>
                                                            <th>{{ trans('sec_trans.actions') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($grade->sections as $key => $list_sections)
                                                            <tr>
                                                                <td>{{ $loop->iteration}}</td>
                                                                <td>{{ $list_sections->name }}</td>
                                                                <td>{{ $list_sections->grade->name }}</td>
                                                                <td>{{ $list_sections->level->name }}
                                                                </td>
                                                                <td>
                                                                    @if ($list_sections->status === 1)
                                                                        <label class="badge badge-success">{{ trans('sec_trans.active') }}</label>
                                                                    @else
                                                                        <label class="badge badge-danger">{{ trans('sec_trans.non-active') }}</label>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="#"
                                                                        class="btn btn-info btn-sm mx-1"
                                                                        data-toggle="modal"
                                                                        data-target="#edit{{ $list_sections->id }}" title={{trans('levels_trans.edit')}} title={{trans('grades_trans.edit')}}><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#delete{{ $list_sections->id }}"  title={{trans('levels_trans.delete')}}><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>

                                                            <!--Edit Section Modal-->
                                                            <div class="modal fade"
                                                                    id="edit{{ $list_sections->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                style="font-family: 'Cairo', sans-serif;"
                                                                                id="exampleModalLabel">
                                                                                {{ trans('sec_trans.edit_section') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                            <span
                                                                                aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form
                                                                                action="{{ route('sections.update', 'test') }}"
                                                                                method="POST">
                                                                                {{ method_field('patch') }}
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <input type="text"
                                                                                                name="name_ar"
                                                                                                class="form-control"
                                                                                                value="{{ $list_sections->getTranslation('name', 'ar') }}">
                                                                                    </div>

                                                                                    <div class="col">
                                                                                        <input type="text"
                                                                                                name="name_en"
                                                                                                class="form-control"
                                                                                                value="{{ $list_sections->getTranslation('name', 'en') }}">
                                                                                        <input id="id"
                                                                                                type="hidden"
                                                                                                name="id"
                                                                                                class="form-control"
                                                                                                value="{{ $list_sections->id }}">
                                                                                    </div>

                                                                                </div>
                                                                                <br>
                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                            class="control-label">{{ trans('sec_trans.grade_name') }}</label>
                                                                                    <select name="grade_id"
                                                                                            class="custom-select"
                                                                                            onclick="console.log($(this).val())">
                                                                                        <!--placeholder-->
                                                                                        <option

                                                                                            value="{{ $list_sections->grade->id }}">

                                                                                            {{ $list_sections->grade->name }}
                                                                                        </option>
                                                                                        @foreach ($grades as $grade)
                                                                                            <option
                                                                                                value="{{ $grade->id }}">
                                                                                                {{ $grade->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br>

                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ trans('sec_trans.level_name') }}</label>
                                                                                    <select name="level_id"
                                                                                            class="custom-select">
                                                                                        <option
                                                                                            value="{{ $list_sections->level->id }}">
                                                                                            {{ $list_sections->level->name }}
                                                                                        </option>
                                                                                        @foreach ($grades as $glevel)
                                                                                        @foreach($glevel->levels as $level)
                                                                                            <option
                                                                                            value="{{ $level->id }}">
                                                                                            {{ $level->name }}
                                                                                        </option>
                                                                                        @endforeach

                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br>
                                                                                <div class="col">
                                                                                    <div class="form-check">
                                                                                        @if ($list_sections->status === 1)
                                                                                            <input
                                                                                                type="checkbox"
                                                                                                checked
                                                                                                class="form-check-input"
                                                                                                name="status"
                                                                                                id="exampleCheck1">
                                                                                        @else
                                                                                            <input
                                                                                                type="checkbox"
                                                                                                class="form-check-input"
                                                                                                name="status"
                                                                                                id="exampleCheck1">
                                                                                        @endif
                                                                                        <label
                                                                                            class="form-check-label"
                                                                                            for="exampleCheck1">{{ trans('sec_trans.status') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label for="teachers">{{trans('sec_trans.select_teacher')}}</label>
                                                                                    <select multiple class="form-control" id="teachers" name="teacher_id[]">
                                                                                        @foreach($list_sections->teachers as $secTeacher)
                                                                                            <option value="{{$secTeacher['id']}}">{{$secTeacher['name']}}</option>
                                                                                            @endforeach
                                                                                        @foreach($teachers as $teacher)
                                                                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn button"
                                                                                    data-dismiss="modal">{{ trans('sec_trans.close') }}</button>
                                                                            <button type="submit"
                                                                                    class="btn btn-danger">{{ trans('sec_trans.submit') }}</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--Delete Section Modal-->
                                                            <div class="modal fade"
                                                                    id="delete{{ $list_sections->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                {{ trans('sec_trans.delete_section') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                            <span
                                                                                aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('sections.destroy', 'test') }}"
                                                                                method="post">
                                                                                {{ method_field('Delete') }}
                                                                                @csrf
                                                                                {{ trans('sec_trans.Warning_section') }}
                                                                                <input id="id" type="hidden"
                                                                                        name="id"
                                                                                        class="form-control"
                                                                                        value="{{ $list_sections->id }}">
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">{{ trans('sec_trans.Close') }}</button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">{{ trans('sec_trans.submit') }}</button>
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
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>

            <!--add new section-->
            <div class="modal fade" id="add" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                id="exampleModalLabel">
                                {{ trans('sec_trans.add_section')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('sections.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="name_ar" class="form-control" placeholder="{{ trans('sec_trans.section_name_ar') }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="name_en" class="form-control" placeholder="{{ trans('sec_trans.section_name_en') }}">
                                    </div>
                                </div>
                                <br>
                                <div class="col">
                                    <label for="inputName"
                                            class="control-label">{{ trans('sec_trans.grade_name') }}</label>
                                    <select name="grade_id" id="grade_id" class="custom-select">
                                        <!--placeholder-->
                                        <option value="" selected
                                                disabled>{{ trans('sec_trans.select_grade') }}
                                        </option>
                                        @foreach ($gradesWithSections as $gWithSections)
                                            <option value="{{ $gWithSections->id }}"
                                            > {{ $gWithSections->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col">
                                    <label for="inputName" class="control-label">{{ trans('sec_trans.level_name') }}</label>
                                    <select name="level_id" id="level_id" class="custom-select"></select>
                                </div>

                                <div class="col">
                                    <label for="teachers">{{trans('sec_trans.select_teacher')}}</label>
                                    <select multiple class="form-control" id="teachers" name="teacher_id[]">
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('sec_trans.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('sec_trans.submit') }}</button>
                        </div>
                        </form>
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
                $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();

                        if (grade_id) {
                                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ URL::to("getLevelsByGrade") }}/" + grade_id,
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


