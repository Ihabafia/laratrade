<x-admin-backend-layout
    title="{{ __('general.edit-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}"
>
    <x-app.page-title page-title="{{ __('general.edit-model', ['model' => \App\Enums\Communication::from($type)->label()]) }}" />

    <form id="updateSms"
          method="post"
          action="{{ route('communications.'.\App\Enums\Communication::from($type)->route().'.update', $communication) }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="form-group col-md-4">
                        <label class="" for="title">{{ __('communications.title-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="title" name="title"
                                       value="{{ old('title', $communication->title) }}" autofocus/>
                        <x-input-error for="title"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="model">{{ __('communications.model-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->model }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="" for="slug">{{ __('communications.slug-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->slug }}</div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-12">
                        <label for="subject">{{ __('communications.subject-label') }} <small class="fw-normal text-warning" style="text-transform: initial">{{ __('communications.sms-subject-warning') }}</small></label>
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
                        <label for="body">{{ __('communications.body-label') }} <x-required /></label>
                        <textarea id="body"
                                  name="body"
                                  rows="10"
                                  class="form-control @error('body') {{'is-invalid'}} @enderror"
                        >{{ old('body', $communication->body) }}</textarea>
                        <x-input-error for="body"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="variables">Allowed Variables {variable}</label>
                        <ul class="list-unstyled disabled p-1">
                            @forelse(isset($communication->variables['sms']) ? $communication->variables['sms'] : [] as $var => $description)
                                <li>&#123;{{$var}}&#125; : <small>{{ $description }}</small></li>
                            @empty
                                <li>There is no variables for this message.</li>
                            @endforelse
                            @if($communication->variables)
                                <li class="mt-3">__variable__ or **variable** to make it <b>bold</b>.</li>
                                <li class="mt-1">To have a new line in the email you have to press <kbd>Enter</kbd> twice.</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i>
                            {{  __('general.update-model', ['model' => 'SMS']) }}
                        </button>
                        <a href="{{route('communications.index')}}" class="btn btn-inverse">{{ __('general.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-backend-layout>
