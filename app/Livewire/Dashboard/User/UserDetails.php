<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public $activeTab = 'arrow-products';

    public function mount($username)
    {
        $this->user = User::where('username',$username)->first();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.dashboard.user.user-details');
    }
}
