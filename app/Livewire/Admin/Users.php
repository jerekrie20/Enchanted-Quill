<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.admin')]
    #[Title('Users')]

    // Searches
    #[Url]
    public $search = '';

    public $sortRole;

    public $sort = 'desc';

    public $perPage = 10;

    public $displayModel = false;

    public $isEditing = false;

    // Forms

    public $name;

    public $email;

    public $role;

    #[Validate]
    public $password;

    #[Validate]
    public $password_confirmation;

    public $avatar;

    public $roleArray = [
        'admin' => 'admin',
        'author' => 'author',
        'reader' => 'reader',
    ];

    #[Locked]
    public $user;

    // Validation Rules
    protected function rules()
    {
        $emailRule = $this->isEditing && $this->user
            ? Rule::unique('users')->ignore($this->user->id)
            : 'unique:users';

        $passwordRule = $this->isEditing ? 'nullable' : 'required';

        return [
            'name' => $this->isEditing ? 'nullable|string|max:255' : 'required|string|max:255',
            'email' => [$this->isEditing ? 'nullable' : 'required', $emailRule, 'string', 'email:rfc', 'max:255'],
            'role' => [$this->isEditing ? 'nullable' : 'required', 'string', Rule::in(['admin', 'author', 'reader'])],
            'password' => [
                $passwordRule,
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    // Validation messages for passwords
    protected $messages = [
        'password.confirmed' => 'Your password confirmation does not match.',
        'password.min' => 'Your password must be at least :min characters.',
        'password.letters' => 'Your password must include at least one letter.',
        'password.mixedCase' => 'Your password must include both uppercase and lowercase characters.',
        'password.numbers' => 'Your password must include at least one number.',
        'password.symbols' => 'Your password must include at least one special character.',
        'password.uncompromised' => 'Your password has been found in a data breach. Please choose a different password.',
    ];

    public function openCreateModal(): void
    {
        $this->reset(['name', 'email', 'role', 'password', 'password_confirmation', 'user', 'isEditing']);
        $this->displayModel = true;
    }

    public function openModal($id): void // Open the modal and set the user
    {
        $this->getUser($id);
        $this->isEditing = true;
        $this->displayModel = true;
    }

    public function closeModal(): void // Close the modal and clear data
    {
        $this->reset(['name', 'email', 'role', 'password', 'password_confirmation', 'user', 'isEditing']);
        $this->displayModel = false;
        $this->resetValidation();
    }

    protected function getUser($id): void
    {
        $getUser = User::find($id);
        // If the user is not the user or not an admin, fail
        $this->authorize('view', $getUser);

        $this->user = $getUser;

        $this->name = $getUser['name'];
        $this->email = $getUser['email'];
        $this->role = $getUser['role'];
    }

    public function save(): void
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->create();
        }
    }

    protected function create(): void
    {
        $this->authorize('create', User::class);

        $validatedData = $this->validate();

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
        ]);

        session()->flash('success', 'User created successfully!');

        $this->closeModal();
    }

    protected function update(): void
    {
        $this->authorize('update', $this->user);

        // Validate the rules defined above
        $validatedData = $this->validate();

        // Remove null values to only update the submitted fields
        $filteredData = array_filter($validatedData);

        // Hash password if it's being updated
        if (isset($filteredData['password'])) {
            $filteredData['password'] = bcrypt($filteredData['password']);
        }

        // Update the user's data with only the changed fields
        $this->user->update($filteredData);

        session()->flash('success', 'User updated successfully!');

        $this->closeModal();
    }

    public function delete($id): void
    { // Delete a User if authorized to do so
        $user = User::find($id);
        $name = $user['name'];
        $this->authorize('delete', $user);
        $user->delete();
        session()->flash('success', "$name was deleted successfully!");
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $users = User::query()
            ->withCount(['blogs', 'comments', 'reviews'])
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->when($this->sortRole, function ($query) {
                $this->resetPage();
                $query->where('role', $this->sortRole);
            })
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        return view('livewire.admin.users', [
            'users' => $users,
        ]);
    }
}
