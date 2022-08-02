<div class="modal fade text-start" id="addNoteForm" tabindex="-1" aria-labelledby="myModalLabel33"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">{{ __('leads.add-note-to__lead__', ['lead' => $lead->full_name]) }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('lead-communication.add-note', [session('active_product')['name'], $lead]) }}" class="px-2 py-2">
                @csrf
                <div class="mb-1">
                    <x-label required="true" value="Note" for="message" />
                    <textarea name="note" id="note" rows="6"
                              class="form-control">{{ old('note') }}</textarea>
                </div>
                <div class="mb-0">
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                        {{ __('general.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
