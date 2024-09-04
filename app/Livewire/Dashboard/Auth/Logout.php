<?php

namespace App\Livewire\Dashboard\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.dashboard.auth.logout');
    }

    public function authLogout()
    {
        auth('admin')->logout();

        return $this->redirectRoute('auth.login',navigate: true);
    }
}
