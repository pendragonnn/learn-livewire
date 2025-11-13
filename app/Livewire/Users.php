<?php

namespace App\Livewire;

use App\Models\User;
use Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Users extends Component
{
    public $title = 'User Page';

    use WithFileUploads;
    use WithPagination;

    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required|email|unique:users')]
    public $email = '';
    #[Validate('required|min:3')]
    public $password = '';
    #[Validate('image|max:1000')]
    public $avatar = '';

    public function createNewUser() 
    {
        $validated = $this->validate();

        if($this->avatar) {
            $validated['avatar'] = $this->avatar->store('avatar', 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $validated['avatar']
        ]);

        // $this->reset(['name', 'email', 'password']); // hapus satu-satu
        $this->reset();

        session()->flash('success', 'User successfully created.');
    }

    public function render()
    {
        return view('livewire.users', [
            'title'=> 'User Page',
            'users'=> User::latest()->paginate(6)
        ]);
    }
}
