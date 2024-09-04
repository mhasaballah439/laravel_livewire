<?php

namespace App\Livewire\Dashboard\Auth;

use App\Models\Admin;
use Livewire\Attributes\Title;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email,$password,$code1,$code2,$code3,$code4;
    public $is_sent = 0;

    protected $rules = [
        'email' => 'required|email',
    ];

    #[Title('Reset password')]
    public function render()
    {
        return view('livewire.dashboard.auth.reset-password')->layout('layouts.login');
    }

    public function resetPassword()
    {
        $this->validate();

        $admin = Admin::where('email',$this->email)->first();
        if (!$admin) {
            $this->dispatch('resetError', __('msg.admin_not_found'));
            return ;
        }
        $admin->verefacation_code = rand(1111,9999);
        $admin->save();

//        event(new PasswordReset($admin));

        $this->is_sent = 1;
        $this->dispatch('resetSuccess', __('msg.code_sent_successfully'));
    }

    public function checkVerificationCode()
    {
        $this->validate([
            'code1' => 'required',
            'code2' => 'required',
            'code3' => 'required',
            'code4' => 'required',
        ]);
        $code = $this->code1.''.$this->code2.''.$this->code3.''.$this->code4;
        $admin = Admin::where('email',$this->email)->first();
        if (!$admin) {
            $this->dispatch('resetError', __('msg.admin_not_found'));
            return ;
        }
        if ($admin->verefacation_code != $code) {
            $this->dispatch('codeError', __('msg.verefacation_code_error'));
            return ;
        }

        $this->is_sent = 2;
        $this->dispatch('codeSuccess', __('msg.code_verified_successfully'));
    }

    public function updatePassword()
    {
        $this->validate([
           'password' => 'required'
        ]);

        $admin = Admin::where('email',$this->email)->first();
        if (!$admin) {
            $this->dispatch('resetError', __('msg.admin_not_found'));
            return ;
        }

        $admin->password = bcrypt($this->password);
        $admin->save();

        return $this->redirectRoute('auth.login',navigate: true);
    }
}
