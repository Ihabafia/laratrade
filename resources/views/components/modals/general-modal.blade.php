<!-- /.modal -->
<div id="{{ $id }}" class="modal fade text-start" id="addNoteForm" tabindex="-1" aria-labelledby="myModalLabel33"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $size ?? 'modal-lg' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">

            </div>
            @isset($footer)
                <div class="modal-footer">
                    <button type="submit" class="btn btn-mtc waves-effect" data-dismiss="modal">Close</button>
                </div>
            @endisset
        </div>
    </div>
</div>
