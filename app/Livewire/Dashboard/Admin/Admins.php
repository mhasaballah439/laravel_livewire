<?php

namespace App\Livewire\Dashboard\Admin;

use App\Models\Admin;
use App\Models\PermitionGroup;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Admins extends Component
{
    use WithFileUploads,WithPagination,WithoutUrlPagination;
    public $name,$email,$permition_group_id,
        $image,$imagePath,$username,$password,
        $phone,$active,$is_super,$item_id;

    public $search = '';
    public $activeTab = 'border-navs-all';


    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    protected $rules = [
        'username' => 'required|unique:admins,username',
        'email' => 'required|unique:admins,email',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->image = '';
        $this->username = '';
        $this->password = '';
        $this->phone = '';
        $this->permition_group_id = '';
        $this->active = false;
        $this->is_super = false;
        $this->item_id = null;
    }

    public function createItem()
    {
        $this->resetFields();

        $this->dispatch('create-item');
    }

    public function close()
    {
        $this->dispatch('close');
    }

    public function storeItem()
    {
        $this->validate([
            'username' => 'required|unique:admins,username',
            'email' => 'required|unique:admins,email',
            'password' => 'required',
        ]);
        $this->resetErrorBag();

        try {
           $admin = new Admin();
           $admin->name = $this->name;
           $admin->email = $this->email;
           $admin->username = $this->username;
           $admin->phone = $this->phone;
           $admin->permition_group_id = $this->permition_group_id;
           $admin->active = $this->active;
           $admin->is_super = $this->is_super;
           $admin->password = bcrypt($this->password);
           $admin->save();

           if($this->image):
                   $img = $this->image->store('uploads/admins', 'public');
                   upload_file($img, 'App\Models\Admin', $admin->id);
               endif;
            $this->resetFields();
            $this->close();

        } catch (Exception $e) {
            // Error response
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


    }

    public function editItem($id)
    {
        $admin = Admin::find($id);
        try {
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->username = $admin->username;
            $this->phone = $admin->phone;
            $this->permition_group_id = $admin->permition_group_id;
            $this->active = $admin->active;
            $this->is_super = $admin->is_super;
            $this->imagePath = isset($admin->image) ? asset($admin->image->file_path) : '';
            $this->image = '';
            $this->item_id = $admin->id;

            $this->dispatch('edit-item');
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function updateItem()
    {
        $admin = Admin::find($this->item_id);
        $this->validate([
            'username' => 'required|unique:admins,username,'.$admin->id,
            'email' => 'required|unique:admins,email,'.$admin->id,
        ]);

        try {
            $admin->name = $this->name;
            $admin->email = $this->email;
            $admin->username = $this->username;
            $admin->phone = $this->phone;
            $admin->permition_group_id = $this->permition_group_id;
            $admin->active = $this->active;
            $admin->is_super = $this->is_super;
            if ($this->password)
                $admin->password = bcrypt($this->password);
            $admin->save();

            if($this->image):
                $img = $this->image->store('uploads/admins', 'public');
                upload_file($img, 'App\Models\Admin', $admin->id);
            endif;

            $this->resetFields();
            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->dispatch('delete-confirmation-item');
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function deleteItem()
    {
        $admin = Admin::find($this->item_id);
        try {
            $admin->delete();

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function restoreConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->dispatch('restore-confirmation-item');
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function restoreItem()
    {
        $admin = Admin::onlyTrashed()->where('id',$this->item_id)->first();
        try {
            $admin->restore();

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function forceDeleteConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->dispatch('force-delete-confirmation-item');
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function forceDelete()
    {
        $admin = Admin::withTrashed()->where('id',$this->item_id)->first();
        try {
            $admin->forceDelete();

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }


    #[Title('Admins')]
    public function render()
    {
        $admins = Admin::where(function ($q){
            $q->where('name','LIKE','%'.$this->search.'%')
                ->orWhere('email','LIKE','%'.$this->search.'%')
                ->orWhere('username','LIKE','%'.$this->search.'%');
        })->paginate(10);

        $trashed_admins = Admin::onlyTrashed()->paginate(10);

        $permissions = PermitionGroup::get();
        return view('livewire.dashboard.admin.admins',[
            'admins' => $admins,
            'trashed_admins' => $trashed_admins,
            'permissions' => $permissions,
        ]);
    }


}
