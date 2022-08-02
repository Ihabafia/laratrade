<!-- Terms Modal -->
<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-{{$size??'lg'}} modal-dialog-{{$openType ?? 'fromleft'}}" role="document">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
<!-- END Terms Modal -->
