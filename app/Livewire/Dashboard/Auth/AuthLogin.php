<?php

namespace App\Livewire\Dashboard\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthLogin extends Component
{
    public $username,$password;
    public $remember_me = false;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.dashboard.auth.auth-login')->layout('layouts.login');
    }

    public function login()
    {
        $this->validate();

        if (Auth::guard('admin')->attempt(['username' => $this->username,'password' => $this->password],$this->remember_me))
            return $this->redirectRoute('dashboard.success_login',navigate: true);
        else
            $this->dispatch('loginError', __('msg.Invalid_credentials'));
    }
}
