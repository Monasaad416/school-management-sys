<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_class{{$online_class->meeting_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('online_class_trans.delete_online_class')}} {{$online_class->topic}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('online_classes.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$online_class->meeting_id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('online_class_trans.warning')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button  class="btn btn-danger">{{trans('students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>