<?php

namespace App\Livewire\Dashboard\Admin;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminProfile extends Component
{
    use WithFileUploads;
    public $name, $username, $email, $password, $phone, $image, $old_password, $new_password, $confirm_password;

    public $activeTab = 'Personal_Details';


    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function close()
    {
        $this->dispatch('close');
    }

    public function updateProfile()
    {
        $admin = admin();

        $this->validate([
            'username' => 'required|unique:admins,username,' . $admin->id,
            'email' => 'required|unique:admins,email,' . $admin->id,
        ]);
        try {

            $admin->name = $this->name;
            $admin->phone = $this->phone;
            $admin->username = $this->username;
            $admin->email = $this->email;
            $admin->save();

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }

    }

    public function changePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        try {
            if (!Hash::check($this->old_password, admin()->password)) {
                $this->dispatch('passError', __('msg.Old_Password_incorrect'));
                return;
            } elseif ($this->new_password != $this->confirm_password) {
                $this->dispatch('passError', __('msg.new_password_not_equal_confirmation'));
                return;
            }

            $admin = admin();
            $admin->password = bcrypt($this->new_password);
            $admin->save();

            $this->close();

        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateImage()
    {

        try {
            $admin = admin();
            if ($this->image):
                $img = $this->image->store('uploads/admins', 'public');
                upload_file($img, 'App\Models\Admin', $admin->id);
            endif;

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function render()
    {
        $admin = admin();
        $this->name = $admin->name;
        $this->phone = $admin->phone;
        $this->username = $admin->username;
        $this->email = $admin->email;
        return view('livewire.dashboard.admin.profile');
    }
}
