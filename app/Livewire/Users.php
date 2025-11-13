<?php

namespace App\Livewire;

use App\Models\User;
use Hash;
use Livewire\Component;

class Users extends Component
{
    public $title = 'User Page';

    public function createUser() 
    {
        User::create([
            'name' => 'User Baru',
            'email' => 'putra@email.com',
            'password' => Hash::make('password')
        ]);
    }

    public function render()
    {
        return view('livewire.users', [
            'title'=> 'User Page',
            'users'=> User::all()
        ]);
    }
}
