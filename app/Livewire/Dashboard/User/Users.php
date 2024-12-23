<?php

namespace App\Livewire\Dashboard\User;

use App\Exports\UsersExport;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserSpecial;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Users extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $name, $email, $phone,$active,$password,$store_name,$default_lang_id,
        $currency_id,$special_id, $item_id, $image,$imagePath;

    public $search = '';
    public $search_special = '';
    public $status = '';
    public $modalId = '';
    public $list = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'phone' => 'required',
        'password' => 'required',
        'default_lang_id' => 'required',
        'currency_id' => 'required',
        'special_id' => 'required',
        'store_name' => 'required|unique:users',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->store_name = '';
        $this->default_lang_id = '';
        $this->currency_id = '';
        $this->special_id = '';
        $this->password = '';
        $this->image = '';
        $this->imagePath = '';
        $this->active = false;
        $this->item_id = null;
    }

    public function createItem()
    {
        $this->resetFields();
        $this->modalId = 'addItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }
    protected function generateUsernameCode()
    {
        do {
            $code = rand(11111111, 99999999);
            $data = User::where('username', $code)->first();
            if (!$data) return $code;
        } while (true);
    }

    public function storeItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {
            $item = new User();
            $item->name = $this->name;
            $item->email = $this->email;
            $item->phone = $this->phone;
            $item->store_name = $this->store_name;
            $item->default_lang_id = $this->default_lang_id;
            $item->currency_id = $this->currency_id;
            $item->special_id = $this->special_id;
            $item->active = $this->active;
            $item->password = bcrypt($this->password);
            $item->username = $this->generateUsernameCode();
            $item->domain = 'http://'.$item->store_name.'.'.env('TenantDomainPrefix');
            $item->save();

//            Tenant::create([
//               'id' =>  $item->store_name
//            ]);

            if($this->image):
                $img = $this->image->store('uploads/users', 'public');
                upload_file($img, 'App\Models\User', $item->id);
            endif;

            $this->resetFields();
            $this->close(__('msg.owner_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editItem($id)
    {
        $item = User::find($id);
        try {
            $this->name = $item->name;
            $this->email = $item->email;
            $this->phone = $item->phone;
            $this->store_name = $item->store_name;
            $this->default_lang_id = $item->default_lang_id;
            $this->currency_id = $item->currency_id;
            $this->special_id = $item->special_id;
            $this->active = $item->active;
            $this->imagePath = isset($item->image) ? asset($item->image->file_path) : '';
            $this->item_id = $item->id;

            $this->modalId = 'editItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateItem()
    {
        $item = User::find($this->item_id);

        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$item->id,
            'phone' => 'required',
            'default_lang_id' => 'required',
            'currency_id' => 'required',
            'special_id' => 'required',
            'store_name' => 'required|unique:users,store_name,'.$item->id,
        ]);

        try {

            $item->name = $this->name;
            $item->email = $this->email;
            $item->phone = $this->phone;
            $item->store_name = $this->store_name;
            $item->default_lang_id = $this->default_lang_id;
            $item->currency_id = $this->currency_id;
            $item->special_id = $this->special_id;
            $item->active = $this->active;
            if ($this->password)
                $item->password = bcrypt($this->password);
            $item->save();

            if($this->image):
                $img = $this->image->store('uploads/users', 'public');
                upload_file($img, 'App\Models\User', $item->id);
            endif;

            $this->close(__('msg.owner_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteItem()
    {
        $item = User::find($this->item_id);
        try {
            $item->delete();

            $this->close(__('msg.owner_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteListConfirmation()
    {
        try {

            $this->modalId = 'deleteListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }
    public function restoreConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'restoreConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function restoreItem()
    {
        $admin = User::onlyTrashed()->where('id',$this->item_id)->first();
        try {
            $admin->restore();

            $this->close(__('msg.owner_has_been_successfully_recovered'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function forceDeleteConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'forceDeleteConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function forceDelete()
    {
        $admin = User::withTrashed()->where('id',$this->item_id)->first();
        try {
            $admin->forceDelete();

            $this->close(__('msg.owner_has_been_permanently_deleted'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function deleteList()
    {

        try {
            User::whereIn('id', $this->list)->delete();
            $this->list = [];
            $this->close(__('msg.owner_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'owners_export_' . date('d_m_Y') . '.xlsx');
    }

    public function activeItem($id)
    {
        $item = User::find($id);
        try {
            if ($item->active == 1)
                $item->active = 0;
            else
                $item->active = 1;
            $item->save();

            $this->close(__('msg.owner_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Users')]
    public function render()
    {
        $items = User::withTrashed();
        if ($this->search)
            $items = $items->where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('store_name', 'LIKE', '%' . $this->search . '%');
            });
        if ($this->search_special)
            $items = $items->where('special_id',$this->search_special);
        if ($this->status == 1)
            $items = $items->where('active',1);
        if ($this->status == 2)
            $items = $items->where('active',0);
        if ($this->status == 3)
            $items = $items->onlyTrashed();

        $items = $items->paginate(10);

        $languages = Language::Active()->get();
        $currencies = Currency::Active()->get();
        $specials = UserSpecial::Active()->get();

        return view('livewire.dashboard.user.users', [
            'items' => $items,
            'languages' => $languages,
            'currencies' => $currencies,
            'specials' => $specials,
        ]);
    }

}
