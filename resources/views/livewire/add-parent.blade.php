<div class="row">
    <div class="col">
        @include('inc.messages')
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                       class="btn btn-circle {{ $current_screen != 1 ? 'btn-default' : 'button' }}">1</a>
                    <p>{{ trans('parent_trans.father_info') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                       class="btn btn-circle {{ $current_screen != 2 ? 'btn-default' : 'button' }}">2</a>
                    <p>{{ trans('parent_trans.mother_info') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                       class="btn btn-circle {{ $current_screen != 3 ? 'btn-default' : 'button' }}"
                       disabled="disabled">3</a>
                    <p>{{ trans('parent_trans.confirm') }}</p>
                </div>
            </div>
        </div>

        @include('livewire.father_form')
        @include('livewire.mother_form')


        <div class="row setup-content {{ $current_screen != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($current_screen != 3)
            <div style="display: none" class="row setup-content" id="step-3">
            @endif
                <div class="col-xs-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{trans('parent_trans.attachments')}}</label>
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        <br>

                        <input type="hidden" wire:model="Parent_id">

                        <button class="button-danger float-right" type="button"
                                wire:click="back(2)">{{ trans('parent_trans.back') }}</button>

                        @if($updateMode)
                    <button class="button-danger float-right mr-2" type="button" wire:click="back(2)">{{ trans('Parent_trans.back') }}</button>
                        @else
                    <button class="button btn-sm btn-lg pull-right" wire:click="submitForm" type="button">{{ trans('Parent_trans.save') }}</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

