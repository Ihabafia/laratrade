<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}" />

    <form id="createEmail"
          method="post"
          action="{{ route('communications.store') }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="form-group col-md-4">
                        <label class="" for="title">{{ __('forms.title-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="title" name="title"
                                       value="{{ old('title', $communication->title ?? '') }}" autofocus/>
                        <x-input-error for="title"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="class">{{ __('forms.method-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="method" name="method"
                                       value="{{ old('method', $communication->method ?? '') }}" />
                        <x-input-error for="method"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="slug">{{ __('forms.slug-label') }}</label>
                        <div class="form-control disabled"><code>{{ __('forms.will-be-generated') }}</code></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-12">
                        <label for="subject">{{ __('forms.subject-label') }} <x-required /></label>
                        <x-input-group id="subject" name="subject"
                                       value="{{ old('subject', $communication->subject ?? '') }}" />
                        <x-input-error for="subject"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-6">
                        <label for="body">{{ __('forms.body-label') }} <x-required /></label>
                        <textarea id="body"
                                  name="body"
                                  rows="20"
                                  class="form-control @error('body') {{'is-invalid'}} @enderror"
                        >{{ old('body', $communication->body ?? '') }}</textarea>
                        <x-input-error for="body"/>
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="form-group col-md-6">
                        <label for="variables">Allowed Variables {variable}</label>
                        <ul class="list-unstyled disabled p-1">
                            @forelse(isset($communication->variables) ? $communication->variables : [] as $var => $description)
                                <li>&#123;{{$var}}&#125; : <small>{{ $description }}</small></li>
                            @empty
                                <li>There is no variables for this message.</li>
                            @endforelse
                            @if(isset($communication->variables))
                                <li class="mt-3">__variable__ or **variable** to make it <b>bold</b>.</li>
                                <li class="mt-1">To have a new line in the email you have to press <kbd>Enter</kbd> twice.</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>
                            {{  __('custom-messages.create-model', ['model' => 'Email']) }}
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
