<table id="data_table" class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{trans('parent_trans.email')}}</th>
        <th scope="col">{{trans('parent_trans.father_name')}}</th>
        <th scope="col">{{trans('parent_trans.father_national_ID')}}</th>
        <th scope="col">{{trans('parent_trans.father_passport_ID')}}</th>
        <th scope="col">{{trans('parent_trans.father_job')}}</th>
        <th scope="col">{{trans('parent_trans.actions')}}</th>
    </tr>
    </thead>
    <tbody>
        {{-- @if(isset($searchparents))
            <?php $my_parents = $searchparents?>
        @else
            <?php $my_parents = $parents?>
        @endif
            --}}
        @foreach($parents as $parent)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$parent->email}}</td>
                <td>{{$parent->getTranslation('father_name','ar')}}<br>{{$parent->getTranslation('father_name','en')}}</td>
                <td>{{$parent->father_national_ID}}</td>
                <td>{{$parent->father_passport_ID}}</td>
                <td>{{$parent->getTranslation('father_job','ar')}}<br>{{$parent->getTranslation('father_job','en')}}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm mx-1" href="{{url("parent/$parent->id")}}" title={{trans('grades_trans.edit')}}>
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm mx-1" title={{trans('grades_trans.delete')}}>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>

            {{-- <!-- Edit Modal -->
            <div class="modal fade" id="edit{{$parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('parent_trans.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form  action="{{route('parents.update',$parent)}}" method="POST">
                        @csrf
                            {{method_field('patch')}}

                            <div class="form-group">
                            <label for="ar_name">{{trans('parent_trans.parent_name_ar')}}</label>
                            <input type="text" value = "{{$parent->getTranslation('name','ar')}}" class="form-control" id="ar_name" name="name_ar" aria-describedby="ar_name" placeholder="{{trans('parent_trans.stage_name_ar')}}">
                            <input type="hidden" id="id" value="{{$parent->id}}" name="id">
                            </div>
                            <div class="form-group">
                                <label for="en_name">{{trans('parent_trans.parent_name_en')}}</label>
                                <input type="text"  value = "{{$parent->getTranslation('name','en')}}" class="form-control" id="en_name"  name="name_en" aria-describedby="en_name" placeholder="{{trans('parent_trans.stage_name_en')}}">
                            </div>

                            <div class="form-group">
                                <div class="col">
                                    <label for="grade_name" class="mr-sm-2">{{ trans('parent_trans.grade_name') }}:</label>
                                    <div class="box">
                                        <select class="fancyselect" name="grade_id">
                                            <option value="{{ $parent->grade->id}}">{{ $parent->grade->name}}</option>
                                            @foreach ($grades as $key=>$grade)
                                                    <option value="{{ $grade->id}}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('parent_trans.close')}}</button>
                                <button type="submit" name="submit" class="btn button">{{trans('parent_trans.submit')}}</button>
                            </div>

                        </form>
                    </div>

                </div>
                </div>
            </div>
            <!-- Delete Modal -->
            <div class="modal fade" id="delete{{$parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('parent_trans.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <p>Are your sure you want to delete {{$parent->name}}?</p>
                        <form  action="{{route('parents.destroy',$parent)}}" method="POST">
                                @csrf
                            {{method_field('delete')}}
                            <input type="hidden" id="id" value="{{$parent->id}}" name="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('parent_trans.close')}}</button>
                                <button type="submit" name="submit" class="btn btn-danger">{{trans('parent_trans.delete')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div> --}}

        @endforeach
    </tbody>
</table>
