<?php

namespace App\Http\Livewire;

use App\Interfaces\Actions\Users\CreatesUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserFormComponent extends Component
{
    public User $user;
    public array $registered_products = [];
    public string $button_label;
    public bool $edit = false;
    public \Illuminate\Support\Collection $roles;
    public array $selected = [];

    protected array $rules = [
        'user.first_name' => ['required', 'string', 'max:255'],
        'user.last_name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
        'user.mobile' => ['nullable', 'string', 'size:10'],
        'user.username' => ['required', 'string', 'max:255'],
        'user.status' => ['required'],
        'selected' => ['required', 'array'],
    ];

    public function mount(User $user, Collection $allClients)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $selectedRoles = $this->user->roles->pluck('id')->toArray();
        $this->selected = $this->roles->filter(fn ($role) => in_array($role->id, $selectedRoles))->pluck('id')->toArray();

        if($this->user?->id) {
            $this->edit = true;
        }

        $this->button_label = $this->user?->id
            ? __('custom-messages.update-model', ['model' => 'User'])
            : __('custom-messages.create-model', ['model' => 'User']);
    }

    public function render()
    {
        return view('livewire.user-form-component');
    }

    public function createUser(CreatesUser $createUser)
    {
        $user = $createUser($this->user, $this->selected);

        return to_route('users.index')
            ->with('success', __('custom-messages.model-updated', ['model' => 'user '.$user->name]))
            ->with('new', $user->new ? $user->id : '');
    }

    /*private function cleanUsername(): string
    {
        $string = strtolower($this->user->first_name.$this->user->last_name);
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }*/
}

