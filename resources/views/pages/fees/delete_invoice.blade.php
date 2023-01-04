{{-- delete invoice item --}}
<div class="modal fade" id="delete_invoice_item{{$invoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('fees_trans.delete_invoice_item')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('invoices.destroy',$invoice->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$invoice->id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('fees_trans.warning_item')}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="button-danger" data-dismiss="modal">{{trans('students_trans.close')}}</button>
                        <button  type="submit" class="button mx-2">{{trans('students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
