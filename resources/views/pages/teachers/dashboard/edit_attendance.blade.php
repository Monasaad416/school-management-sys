
<div class="modal fade" id="edit_attendance{{$stud->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('attendance_trans.edit_attendance')}} : {{$stud->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('t_attendance.update',$stud->id)}}" method="post">
                    @csrf
        
                    <input type="hidden" name="student_id" value="{{$stud->id}}">
                    @if($stud->attendance()->where('attendance_date',date('Y-m-d'))->first() !== null)
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendance" {{ $stud->attendance->first()->attendance_status == 1 ? 'checked' : '' }} class="leading-tight" type="radio" value="present"> <span class="text-success">{{trans('attendance_trans.attend')}}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendance" {{ $stud->attendance->first()->attendance_status == 0 ? 'checked' : '' }} class="leading-tight" type="radio" value="absent"> <span class="text-danger">{{trans('attendance_trans.absent')}}</span>
                        </label>
                    @else
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendance" class="leading-tight" type="radio" value="present"> <span class="text-success">{{trans('attendance_trans.attend')}}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendance"  class="leading-tight" type="radio" value="absent"> <span class="text-danger">{{trans('attendance_trans.absent')}}</span>
                        </label>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button class="btn btn-danger">{{trans('students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
