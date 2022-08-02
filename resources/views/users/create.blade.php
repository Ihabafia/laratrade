<x-admin-backend-layout
    title="{{ $user?->id ? __('custom-messages.update-model', ['model' => 'User']) : __('custom-messages.create-model', ['model' => 'User']) }}"
>
    <x-app.page-title page-title="{{ $user?->id
        ? __('custom-messages.update-model', ['model' => 'User'])
        : __('custom-messages.create-model', ['model' => 'User']) }}" />

    <div class="card">
        <div class="card-body">
            <livewire:user-form-component :user="$user"/>
        </div>
    </div>
</x-admin-backend-layout>
