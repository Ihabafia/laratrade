@section('title', __('product-enums.create-a-product'))
<x-admin-backend-layout
    title="{{ __('general.update-model', ['model' => 'PRC']) }}"
    :breadcrumb="[current_route(), $communication, $type]"
>
    <x-notification-messages />
    <form id="leadForm"
          method="post"
          enctype="multipart/form-data"
          action="{{ route('communications.prc.update', $communication) }}"
          class="form-horizontal r-separator masked-form"
    >
        @csrf
        @method('put')
        <div class="block block-rounded mt-4">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __('communications.edit-type', ['type' => "PRC"]) }}</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row mb-2">
                    <div class="form-group col-md-4 mb-3">
                        <label class="" for="title">{{ __('communications.title-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="title" name="title"
                                       value="{{ old('title', $communication->title) }}" autofocus/>
                        <x-input-error for="title"/>
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label class="" for="model">{{ __('communications.model-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->model }}</div>
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label class="" for="slug">{{ __('communications.slug-label') }}
                            <x-required/>
                        </label>
                        <div class="form-control disabled">{{ $communication->slug }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 mb-3">
                        <label class="" for="subject">{{ __('communications.subject-label') }}
                            <x-required/>
                        </label>
                        <x-input-group id="subject" name="subject"
                                       value="{{ old('subject', $communication->subject ?? '') }}" autofocus/>
                        <x-input-error for="subject"/>
                    </div>
                </div>
                <div class="row">
                    <div id="file_name" class="form-group col-md-12 mb-3">
                        <label for="file_name">{{ __('communications.vc-filename-label') }}</label>
                        <div class="form_control">
                            <audio controls src="{{ asset('storage/' . $communication->vc_filename) }}">
                                <div style="border: 1px solid black ; padding: 8px ;">
                                    Sorry, your browser does not support the <code><audio></code> tag used in this demo.
                                </div>
                            </audio>
                        </div>

                        <input id="file_name"
                               type="file"
                               class="form-control-file @error('file_name') {{'is-invalid'}} @enderror"
                               name="file_name"
                        >
                        <x-input-error for="file_name"/>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-alt-primary me-md-0 mt-4 mb-5"> <i class="fa fa-check"></i>
                            {{  __('general.update-model', ['model' => 'PRC']) }}
                        </button>
                        <a href="{{route('communications.index')}}" class="btn btn-inverse me-md-0 mt-4 mb-5">{{ __('general.cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-backend-layout>
