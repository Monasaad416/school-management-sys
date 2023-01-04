
<form id="exam-submit-form" wire:submit.prevent="submitQuiz({{$quiz_id}})">
    @csrf
    @foreach($quiz_details as $ques)
        <div class="col-12">
            <h3 class="">{{$loop->iteration}}-{{$ques->title }}</h3>
            <div class="mx-3">
                <div class="form-row" form="exam-submit-form">
                    <div class="col-12">
                        <label>
                            <input type="radio" wire:model="answers.{{$ques->id}}" value="1">
                            {{$ques->option_1 }}
                        </label>
                    </div>
                    @error('answers.{{$ques->id}}')<span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="form-row" form="exam-submit-form">
                    <div class="col-12">
                        <label>
                            <input type="radio" wire:model="answers.{{$ques->id}}" value="2">
                            {{$ques->option_2 }}
                        </label>
                    </div>
                    @error('answers.{{$ques->id}}')<span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="form-row" form="exam-submit-form">
                    <div class="col-12">
                        <label>
                            <input type="radio" wire:model="answers.{{$ques->id}}" value="3">
                            {{$ques->option_3 }}
                        </label>
                    </div>
                    @error('answers.{{$ques->id}}')<span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="form-row" form="exam-submit-form">
                    <div class="col-12">
                        <label>
                            <input type="radio" wire:model="answers.{{$ques->id}}" value="4">
                            {{$ques->option_4 }}
                        </label>
                    </div>
                    @error('answers.{{$ques->id}}')<span class="text-red-700 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <hr>
    @endforeach
    <div>
        <button type="submit" form="exam-submit-form" class="button">{{trans('levels_trans.submit')}}</button>
    </div>

</form>








