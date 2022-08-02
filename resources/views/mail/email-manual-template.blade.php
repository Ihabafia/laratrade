<x-mail.template noThankYou="true">
    <x-mail.custom>
        {!! nl2br($body) !!}
    </x-mail.custom>

    <x-mail.div style="margin-top:30px;">
        {{ $user->full_name }}<br>
        Mobile: <a href="tel:+1{{$user->mobile}}">{{ formatPhone($user->mobile) }}</a><br>
        Email: <a href="mailto:{{$user->email}}?subject=Re: {{$subject}}">{{ $user->email }}</a><br>
        <img src="{{ route('track.link', [$track, $id]) }}"  width="1" height="1" border="0" onerror="this.src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='" />
    </x-mail.div>
</x-mail.template>
