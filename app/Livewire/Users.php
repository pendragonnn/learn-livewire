<?php

namespace App\Livewire;

use App\Models\User;
use Hash;
use Livewire\Component;

class Users extends Component
{
    public $title = 'User Page';
    public $name = '';
    public $email = '';
    public $password = '';

    public function createNewUser() 
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        // $this->reset(['name', 'email', 'password']); // hapus satu-satu
        $this->reset();
    }

    public function render()
    {
        return view('livewire.users', [
            'title'=> 'User Page',
            'users'=> User::all()
        ]);
    }
}
