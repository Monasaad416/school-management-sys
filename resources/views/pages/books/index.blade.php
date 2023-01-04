@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
  {{trans('books_trans.books_list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('books_trans.books_list')}}
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
                            <div class="card-body">
                                <a href="{{route('books.create')}}" class="button my-4 btn-sm" role="button"
                                   aria-pressed="true">  {{trans('books_trans.add_book')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>  {{trans('books_trans.book_name')}}</th>
                                            <th>  {{trans('techs_trans.teacher_name')}}</th>
                                            <th>  {{trans('students_trans.grade')}}</th>
                                            <th>  {{trans('students_trans.level')}}</th>
                                            <th>  {{trans('students_trans.section')}}</th>
                                            <th>  {{trans('students_trans.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teacher->name}}</td>
                                                <td>{{$book->grade->name}}</td>
                                                <td>{{$book->level->name}}</td>
                                                <td>{{$book->section->name}}</td>
                                                <td>
                                                    {{-- <a href="{{route('downloadAttachment',$book->file_name)}}" title="<th>  {{trans('books_trans.download')}}</th>" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a> --}}
                                                    <a href="{{route('books.edit',$book->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title={{trans('grades_trans.edit')}}><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}" title={{trans('grades_trans.delete')}}><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
{{-- 
                                        @include('pages.books.destroy') --}}
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
            {!! $books->links() !!}
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection