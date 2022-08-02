@section('title', __('custom-messages.create-model', ['model' => 'PRC']))
<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => 'PRC']) }}"
    :breadcrumb="[current_route(), $type]"
>
    <x-notification-messages />
    <form id="leadForm"
          method="post"
          enctype="multipart/form-data"
          action="{{ route('communications.prc.store') }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf
        <div class="block block-rounded mt-4">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('custom-messages.create-model', ['model' => "PRC"]) }}</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row mb-2">
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="title">{{ __('forms.title-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="title" name="title"
                                       value="{{ old('title', $communication->title ?? '') }}" autofocus/>
                        <x-input-error for="title"/>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="model">{{ __('forms.model-label') }}
                            <x-required/>
                        </label>
                        <x-enums-dropdown id="model"
                                          name="model"
                                          object="model"
                                          select2=""
                                          :model="\App\Enums\ModelEnums::toArray()"
                                          selected="{{ old('model', $communication->model ?? '') }}"
                                          serror="{{ $errors->first('model') }}"
                        />
                        <x-input-error for="model"/>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="class">{{ __('forms.class-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="class" name="class"
                                       value="{{ old('class', $communication->class ?? '') }}" autofocus/>
                        <x-input-error for="class"/>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="slug">{{ __('forms.slug-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled"><code>{{ __('forms.will-be-generated') }}</code></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="subject">{{ __('forms.subject-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="subject" name="subject"
                                       value="{{ old('subject', $communication->subject ?? '') }}" autofocus/>
                        <x-input-error for="subject"/>
                    </div>
                </div>
                <div class="row">
                    <div id="file_name" class="form-group col-md-3 mb-3">
                        <label for="file_name">{{ __('forms.vc-filename-label') }}</label>
                        <div class="input-group @error('file_name') {{'is-invalid'}} @enderror">
                            <input id="file_name"
                                   type="file"
                                   class="form-control-file @error('file_name') {{'is-invalid'}} @enderror"
                                   name="file_name"
                            >
                        </div>
                        <x-input-error for="file_name"/>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-0 mt-4 mb-5"> <i class="fa fa-check"></i>
                            {{  __('custom-messages.create-model', ['model' => 'PRC']) }}
                        </button>
                        <a href="{{route('communications.index')}}" class="btn btn-inverse me-md-0 mt-4 mb-5">{{ __('buttons.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-backend-layout>
