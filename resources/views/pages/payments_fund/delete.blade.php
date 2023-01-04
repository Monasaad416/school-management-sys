
<div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('fees_trans.delete_payment_voucher')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('payments_fund.destroy',$payment->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$payment->id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('fees_trans.warning_payment')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button  class="button-danger">{{trans('students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
