<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $title = 'User Page';
    public function render()
    {
        return view('livewire.users', [
            'title'=> 'User Page',
            'users'=> User::all()
        ]);
    }
}
