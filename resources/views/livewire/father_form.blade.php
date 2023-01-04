@if($current_screen != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label>{{trans('parent_trans.email')}}</label>
                        <input type="email" wire:model="email" name="email" class="form-control">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.password')}}</label>
                        <input type="password" wire:model="password" class="form-control" >
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label>{{trans('parent_trans.father_name_ar')}}</label>
                        <input type="text" wire:model ="father_name_ar" class="form-control" >
                        @error('father_name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.father_name_en')}}</label>
                        <input type="text" wire:model="father_name_en" class="form-control" >
                        @error('father_name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label>{{trans('parent_trans.father_job_ar')}}</label>
                        <input type="text" wire:model="father_job_ar" class="form-control">
                        @error('father_job_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>{{trans('parent_trans.father_job_en')}}</label>
                        <input type="text" wire:model="father_job_en" class="form-control">
                        @error('father_job_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.father_national_ID')}}</label>
                        <input type="text" wire:model="father_national_ID" class="form-control">
                        @error('father_national_ID')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.father_passport_ID')}}</label>
                        <input type="text" wire:model="father_passport_ID" class="form-control">
                        @error('father_passport_ID')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>{{trans('parent_trans.father_phone')}}</label>
                        <input type="text" wire:model="father_phone" class="form-control">
                        @error('father_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parent_trans.father_nationality_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($nationalities as $national)
                                <option value="{{$national->id}}">{{$national->name}}</option>
                            @endforeach
                        </select>
                        @error('father_nationality_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parent_trans.father_blood_type_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_blood_type_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($blood_types as $b_type)
                                <option value="{{$b_type->id}}">{{$b_type->name}}</option>
                            @endforeach
                        </select>
                        @error('father_blood_type_id')
                         <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parent_trans.father_religion_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_religion_id">
                            <option selected>{{trans('parent_trans.choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </select>
                        @error('father_religion_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parent_trans.father_address')}}</label>
                    <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('father_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="button float-right my-2" wire:click="firstStep" >{{trans('parent_trans.next')}}</button>

            </div>
        </div>
        @if($current_screen != 1)
    </div>
    @endif
