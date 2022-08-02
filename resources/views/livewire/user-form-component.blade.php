<div>
    <div class="row">
        <div class="form-group col-md-3 mt-2">
            <x-label for="first_name">{{ __('forms.first-name-label') }} <x-required/></x-label>
            <x-input-group id="first_name" wire:model.defer="user.first_name" />
            <x-input-error for="first_name"/>
        </div>
        <div class="form-group col-md-3 mt-2">
            <x-label for="last_name">{{ __('forms.last-name-label') }} <x-required/></x-label>
            <x-input-group id="last_name" wire:model.defer="user.last_name" />
            <x-input-error for="last_name"/>
        </div>
        <div class="form-group col-md-3 mt-2">
            <x-label for="email">{{ __('forms.email-label') }} <x-required/></x-label>
            <x-input-group id="email" wire:model.defer="user.email" />
            <x-input-error for="email"/>
        </div>
        <div class="form-group col-md-3 mt-2">
            <x-label for="mobile">{{ __('forms.mobile-label') }}</x-label>
            <x-input-group id="mobile" maxlength="10" wire:model.defer="user.mobile" />
            <x-input-error for="mobile"/>
        </div>
        <div class="form-group col-md-4 mt-2">
            <x-label for="username">{{ __('forms.username-label') }} <x-required/></x-label>
            @if($edit)
                <div class="disabled form-control" disabled>{{$user->username}}</div>
            @else
                <x-input-group id="username" wire:model.defer="user.username" />
                <x-input-error for="username"/>
            @endif
        </div>
        @hasrole('Admin')
            <div class="form-group col-md-4 mt-2">
                <x-label for="status">{{ __('forms.status-label') }} <x-required/></x-label>
                <select name="status" wire:model.defer="user.status" class="form-select @error('status'){{ 'is-invalid' }}@enderror" style="width: 100%">
                    <option value="">{{ __('custom-messages.select-model', ['model' => 'Status']) }}</option>
                    @foreach (\App\Enums\UserStatusEnum::cases() as $status)
                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                    @endforeach
                </select>
                <x-input-error for="status"/>
            </div>
        @endhasrole
        <div class="form-group col-md-12 mt-2">
            <x-label for="selected">{{ __('forms.access-level-label') }} <x-required/></x-label>
            <div class="form-control {{ $errors->has('selected') ? 'is-invalid':'' }}">
                <div class="d-flex flex-wrap">
                    @forelse($roles as $role)
                        <div class="form-check form-switch me-4">
                            <input wire:model.defer="selected"
                                   value="{{ $role->id }}"
                                   class="form-check-input"
                                   type="checkbox"
                            >
                            <label class="form-check-label" for="selected">{{ \App\Enums\RoleEnum::from($role->name)->label() }}</label>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <x-input-error for="selected"/>
        </div>



        <div class="row mt-2">
            <div class="col-12">
                <button wire:click.prevent="createUser" type="submit" class="btn btn-primary me-md-0"> <i class="fa fa-check"></i>
                    {{ $button_label }}</button>
                <a href="{{route('users.index')}}" class="btn btn-inverse me-md-0">{{ __('buttons.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
