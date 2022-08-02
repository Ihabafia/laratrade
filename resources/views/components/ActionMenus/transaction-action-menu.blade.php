@props([
    'buttonTitle' => '<i data-feather="more-vertical"></i>',
    'transaction' => null,
])
<button type="button"
        {{ $attributes->merge(['class' => "btn dropdown-toggle"]) }}
        data-bs-toggle="dropdown"
        aria-expanded="false"
>
    {!! $buttonTitle !!}
</button>
<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item fetchTransactionDetails"
       href="#" {{--data-bs-toggle="modal" data-bs-target="#packageDetails"--}}
       data-id="{{$transaction->id}}"
    >
        <i data-feather="edit-2" class="me-50"></i>
        <span>{{ __('forms.view-details-title') }}</span>
    </a>

    <a class="dropdown-item" href="#">
        <i data-feather="edit-2" class="me-50"></i>
        <span>{{ __('forms.pause-title') }}</span>
    </a>
    @if($transaction->status !== \App\Enums\PaymentStatusEnum::HardNsf)
        <form class="masked-form confirmation_form"
              action="{{ route('payment.hard-nsf', $transaction) }}"
              method="POST"
        >
            @csrf
            <button type="submit"
                    class="dropdown-item js_confirmation"
                    data-message="Mark the transactions as Hard NSF?"
            >
                <i data-feather="trash" class="me-50"></i>
                {{ __('forms.mark-as-nsf-title') }}
            </button>
        </form>
    @endif
</div>

