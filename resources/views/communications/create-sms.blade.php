<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.create-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}" />

    <form id="createSms"
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
                        <label class="" for="method">{{ __('forms.method-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="method" name="method"
                                       value="{{ old('method', $communication->method ?? '') }}" autofocus/>
                        <x-input-error for="method"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="slug">{{ __('forms.slug-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled"><code>{{ __('forms.will-be-generated') }}</code></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-12">
                        <label for="subject">{{ __('forms.subject-label') }} <small class="fw-normal text-warning" style="text-transform: initial">{{ __('messages.sms-subject-warning') }}</small></label>
                        <x-input-group id="subject" name="subject"
                                       value="{{ old('subject', $communication->subject ?? '') }}" />
                        <x-input-error for="subject"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-6">
                        <label for="body">{{ __('forms.body-label') }} <x-required /></label>
                        <div id="editor">
                        <textarea id="body"
                                  name="body"
                                  rows="10"
                                  class="form-control @error('body') {{'is-invalid'}} @enderror"
                        >{{ old('body', $communication->body ?? '') }}</textarea>
                        </div>
                        <x-input-error for="body"/>
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="form-group col-md-6">
                        <label for="variables">Allowed Variables {variable}</label>
                        <ul class="list-unstyled disabled p-1">
                            @forelse(isset($communication->variables['sms']) ? $communication->variables['sms'] : [] as $var => $description)
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
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>
                            {{  __('custom-messages.create-model', ['model' => 'SMS']) }}
                        </button>
                        <a href="{{route('communications.index')}}" class="btn btn-inverse">{{ __('buttons.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-backend-layout>
