<?php

namespace App\Livewire;

use App\Models\User;
use Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Users extends Component
{
    public $title = 'User Page';

    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required|email|unique:users')]
    public $email = '';
    #[Validate('required|min:3')]
    public $password = '';

    public function createNewUser() 
    {
        // $validated = $this->validate([
        //     'name' => 'required|min:3',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:3'
        // ]);

        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        // $this->reset(['name', 'email', 'password']); // hapus satu-satu
        $this->reset();

        session()->flash('success', 'User successfully created.');
    }

    public function render()
    {
        return view('livewire.users', [
            'title'=> 'User Page',
            'users'=> User::all()
        ]);
    }
}
