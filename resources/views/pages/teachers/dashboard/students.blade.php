@extends('layouts.master')
@section('css')
@toastr_css
    @section('title')
    {{trans('students_trans.page_title')}}
    @endsection
@endsection
@section('page-header')

@endsection

@section('content')
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive mt-15">
                        <form method="post" action="{{ route('t_attendance.store') }}">
                            @csrf
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
                                    <th scope="col">{{trans('attendance_trans.page_title')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($students_teacher as $stud)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$stud->name}}</td>
                                            <td>{{$stud->email}}</td>
                                            <td>{{$stud->gender->name}}</td>
                                            <td>{{$stud->grade->name}}</td>
                                            <td>{{$stud->level->name}}</td>
                                            <td>{{$stud->section->name}}</td>
                                            <td>
                                            @if($stud->attendance()->where('attendance_date',date('Y-m-d'))->first() !== null)

                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="attendances[{{ $stud->id }}]"

                                                     {{$stud->attendance()->where('attendance_date',date('Y-m-d'))->first()->attendance_status == 1 ? 'checked disabled ' : '' }}

                                                        class="leading-tight" type="radio"
                                                        value="present">
                                                    <span class="text-success">{{trans('attendance_trans.attend')}}</span>
                                                </label>
                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                    <input name="attendances[{{ $stud->id }}]"

                                                        {{ $stud->attendance()->where('attendance_date',date('Y-m-d'))->first()->attendance_status == 0 ? 'checked disabled' : '' }}

                                                        class="leading-tight" type="radio"
                                                        value="absent">
                                                    <span class="text-danger">{{trans('attendance_trans.absent')}}</span>
                                                </label>
                                            @else
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="attendances[{{ $stud->id }}]"

                                                        class="leading-tight" type="radio"
                                                        value="present">
                                                    <span class="text-success">{{trans('attendance_trans.attend')}}</span>
                                                </label>
                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                    <input name="attendances[{{ $stud->id }}]"

                                                        class="leading-tight" type="radio"
                                                        value="absent">
                                                    <span class="text-danger">{{trans('attendance_trans.absent')}}</span>
                                                </label>
                                            @endif

                                            <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#edit_attendance{{$stud->id}}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>

                                                @include('pages.teachers.dashboard.edit_attendance')


                                                <input type="hidden" name="grade_id" value="{{ $stud->grade_id }}">
                                                <input type="hidden" name="level_id" value="{{ $stud->level_id }}">
                                                <input type="hidden" name="section_id" value="{{ $stud->section_id }}">
                                                <input type="hidden" name="teacher_id" value="{{ $teacher_id }}">

                                            </td>

                                            {{-- <!--delete modal-->
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
                                                                    <button  class="button mx-2">{{trans('students_trans.submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <P>
                                <button class="button float-right" type="submit">{{ trans('Students_trans.submit') }}</button>
                            </P>
                        </form>
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
                        <button type="submit" name="submit" class="btn btn-primary">{{trans('students_trans.submit')}}</button>
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
@endsection
