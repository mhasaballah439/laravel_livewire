<?php

namespace App\Livewire\Dashboard\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

class SuccessLogin extends Component
{
    #[Title('Success login')]
    public function render()
    {
        return view('livewire.dashboard.auth.success-login')->layout('layouts.login');
    }
}
