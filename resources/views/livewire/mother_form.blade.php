@if($current_screen != 2)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label>{{trans('parent_trans.mother_name_ar')}}</label>
                        <input type="text" wire:model ="mother_name_ar" class="form-control" >
                        @error('mother_name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.mother_name_en')}}</label>
                        <input type="text" wire:model="mother_name_en" class="form-control" >
                        @error('mother_name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label>{{trans('parent_trans.mother_job_ar')}}</label>
                        <input type="text" wire:model="mother_job_ar" class="form-control">
                        @error('mother_job_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>{{trans('parent_trans.mother_job_en')}}</label>
                        <input type="text" wire:model="mother_job_en" class="form-control">
                        @error('mother_job_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{trans('parent_trans.mother_national_ID')}}</label>
                        <input type="text" wire:model="mother_national_ID" class="form-control">
                        @error('mother_national_ID')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.mother_passport_ID')}}</label>
                        <input type="text" wire:model="mother_passport_ID" class="form-control">
                        @error('mother_passport_ID')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{trans('parent_trans.mother_phone')}}</label>
                        <input type="text" wire:model="mother_phone" class="form-control">
                        @error('mother_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parent_trans.mother_nationality_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($nationalities as $national)
                                <option value="{{$national->id}}">{{$national->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_nationality_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parent_trans.mother_blood_type_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_blood_type_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($blood_types as $b_type)
                                <option value="{{$b_type->id}}">{{$b_type->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_blood_type_id')
                         <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parent_trans.mother_religion_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_religion_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_religion_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parent_trans.mother_address')}}</label>
                    <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('mother_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="button float-right my-5 mx-2" wire:click="secStep" >{{trans('parent_trans.next')}}</button>
                <button class="button-danger float-right my-5 mx-2" wire:click="back(2)" >{{trans('parent_trans.back')}}</button>

            </div>
        </div>
    </div>
