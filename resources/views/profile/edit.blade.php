<x-admin-backend-layout
    title="{{ $user?->id
        ? __('custom-messages.update-model', ['model' => 'Profile'])
        : __('custom-messages.create-model', ['model' => 'Profile']) }}"
>
    <x-app.page-title page-title="{{ $user?->id
        ? __('custom-messages.update-model', ['model' => 'Profile'])
        : __('custom-messages.create-model', ['model' => 'Profile']) }}"
    />

    <form id="profileForm"
          method="post"
          action="{{ route('profile.update', $user) }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf
        @isset($user->id)
            @method('put')
        @endisset
        <div class="card">
            <div class="card-body row">
                <div class="form-group col-md-4 mt-2">
                    <x-label for="first_name">{{ __('forms.first-name-label') }} <x-required/></x-label>
                    <x-input-group id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" />
                    <x-input-error for="first_name"/>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <x-label for="last_name">{{ __('forms.last-name-label') }} <x-required/></x-label>
                    <x-input-group id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" />
                    <x-input-error for="last_name"/>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <x-label for="email">{{ __('forms.email-label') }} <x-required/></x-label>
                    <x-input-group id="email" name="email" value="{{ old('email', $user->email) }}" />
                    <x-input-error for="email"/>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <x-label for="mobile">{{ __('forms.mobile-label') }}</x-label>
                    <x-input-group id="mobile" class="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" />
                    <x-input-error for="mobile"/>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <x-label for="password">{{ __('forms.current-password-label') }}</x-label>
                    <x-input-group id="password" name="password" type="password" />
                    <x-input-error for="password" />
                </div>
                <div class="form-group col-md-4 mt-2">
                    <x-label for="password_confirmation">{{ __('forms.confirm-password-label') }}</x-label>
                    <x-input-group id="password_confirmation" name="password_confirmation" type="password" />
                    <x-input-error for="password_confirmation" />
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-md-0"> <i class="fa fa-check"></i>
                            {{ __('custom-messages.update-model', ['model' => 'Profile']) }}</button>
                        <a href="{{route('dashboard.index')}}" class="btn btn-inverse me-md-0">{{ __('buttons.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js_after')
        <script>
            $(document).ready(function() {
                _empty_owner = $('#owner').html();
                $("#owner").detach();

                serialNumber = [];
                accumulated = $(".owner").length;

                serializeOwners();
                checkDeleteOwner();
            });

            $(document).on("click", ".add_owner", function (e) {
                e.preventDefault();
                addNewOwner();
                checkDeleteOwner();
            });

            $(document).on("click", ".delete", function () {
                if($(".owner").lenth === 1) {
                    return false;
                }

                $owner = $(this).closest('.owner');
                $owner.detach();

                serializeOwners();
                checkDeleteOwner();
            })

            function addNewOwner() {
                emptyOwner = _empty_owner.replaceAll('_id_', accumulated);
                serialNumber[accumulated] = 0;
                $("#owners").append(emptyOwner);

                remask($("#owner-"+accumulated));
                serializeOwners();
                ++accumulated;
            }

            function remask($section) {
                $section.find('.phone, .mobile').mask('(000) 000-0000');
            }

            function checkDeleteOwner() {
                i = $('.owner').length;

                if (i > 1) {
                    $(".deleteButton").show();
                } else {
                    $(".deleteButton").hide();
                }
            }

            function serializeOwners() {
                $(document).find(".owner").each(function(index) {
                    $(".serial", $(this)).html(index+1);
                });
            }
        </script>
    @endpush
</x-admin-backend-layout>

