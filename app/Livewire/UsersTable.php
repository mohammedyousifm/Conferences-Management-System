<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UsersTable extends Component
{
    public $users;

    public function mount()
    {
        $this->loadUsers(); // Load users when the component is first mounted
    }

    public function loadUsers()
    {
        $this->users = User::latest()->get();
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::latest()->get(), // Always fetch fresh users
        ])->layout('layouts.app');
    }
}
