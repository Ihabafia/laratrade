<x-admin-backend-layout
    title="{{ $communication?->id
        ? __('custom-messages.update-model', ['model' => \App\Enums\Communication::from($type)->label()])
        : __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}"
>
    <x-app.page-title page-title="{{ $communication?->id
        ? __('custom-messages.update-model', ['model' => \App\Enums\Communication::from($type)->label()])
        : __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}"
    />

    <form id="leadForm"
          method="post"
          action="{{ route('communications.update', $communication) }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="form-group col-md-4">
                        <label class="" for="title">{{ __('forms.title-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="title" name="title"
                                       value="{{ old('title', $communication->title) }}" autofocus/>
                        <x-input-error for="title"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="model">{{ __('forms.method-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->method }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="slug">{{ __('forms.slug-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->slug }}</div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-12">
                        <label for="subject">{{ __('forms.subject-label') }}</label>
                        <input id="subject"
                               type="text"
                               name="subject"
                               class="form-control"
                               value="{{ old('subject', $communication->subject) }}"
                               data-parsley-required
                               data-parsley-trigger="change focusout"
                               data-parsley-required-message="Subject field is required"
                        >
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-6">
                        <label for="body">{{ __('forms.body-label') }}</label>
                        <div id="editor">
                        <textarea id="body"
                                  name="body"
                                  rows="20"
                                  class="form-control @error('body') {{'is-invalid'}} @enderror"
                        >{{ old('body', $communication->body) }}</textarea>
                        </div>
                        <x-input-error for="body"/>
                    </div>
                    <input type="hidden" name="type" value="{{ $communication->type }}">
                    <div class="form-group col-md-6">
                        <label for="variables">{{ __('messages.allowed-variables') }}</label>
                        <ul class="list-unstyled disabled p-1">
                            <li class="fw-600 mb-1">{{ __('messages.allowed-variables-message') }}</li>
                            @php($int = false)
                            @php($button = false)
                            @forelse(isset($communication->variables['email']) ? $communication->variables['email'] : [] as $var_name => $attributes)
                                <li class="fw-500">{{--&#123;&#123; $--}}{{$attributes['mask']}}{{-- &#125;&#125;--}} : <span class="fw-normal">{{ $attributes['type'] }}</span></li>
                                @if($attributes['type'] == 'int' || $attributes['type'] == 'integer')
                                    @php($int = true)
                                @endif
                                @if($attributes['type'] == 'button')
                                    @php($button = true)
                                @endif
                            @empty
                                <li>{{ __('messages.there-is-no-variables') }}</li>
                            @endforelse
                                <li class="mb-1"> </li>
                            @if($button)
                                <li>{!! __('custom-messages.you-can-use-these-colors') !!}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>
                            {{  __('custom-messages.update-model', ['model' => 'Email']) }}
                        </button>
                        <a href="{{route('communications.index')}}" class="btn btn-inverse">{{ __('buttons.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @push('css_after')
        <script
            src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBd-6f9OmA3ayARwWloQ0Tsa2GmOFFzgN0"></script>
    @endpush
    @push('js_after')
        <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#body' ) , {
                    removePlugins: [ 'Heading', 'link', 'blockQuote', 'CKFinder' ],
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList' ],
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
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
