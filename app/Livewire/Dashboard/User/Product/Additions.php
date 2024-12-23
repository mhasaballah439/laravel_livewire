<?php

namespace App\Livewire\Dashboard\User\Product;

use App\Models\Addition;
use App\Models\Tenant;
use App\Models\TenantMedia;
use App\Models\User;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Additions extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $name, $price, $active, $image, $imagePath, $item_id;

    public $search = '';
    public $status = '';
    public $tenant = '';
    public $modalId = '';
    public $additions_list = [];

    protected $rules = [
        'name' => 'required',
        'price' => 'required',
    ];

    public function mount($username)
    {
        $user = User::where('username', $username)->first();
        $this->tenant = Tenant::findOrFail($user->store_name);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->price = '';
        $this->image = '';
        $this->active = false;
        $this->item_id = null;
    }

    public function createAdditionItem()
    {
        $this->resetFields();
        $this->modalId = 'addAdditionItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }


    public function storeAdditionItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {

            $this->tenant->run(function () {
                $item = new Addition();
                $item->name = $this->name;
                $item->price = $this->price;
                $item->active = $this->active;
                $item->save();

                if ($this->image) {
                    $tenantId = $this->tenant->id;
                    $fileName = $this->image->getClientOriginalName();

                    $filePath = $this->image->storeAs(
                        "uploads/tenant/additions/{$tenantId}",
                        $fileName,
                        'public'
                    );

                    upload_tenant_file($filePath, 'App\Models\Addition', $item->id, $fileName, 'image');
                }
            });


            $this->resetFields();
            $this->close(__('msg.addition_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editAdditionItem($id)
    {
        try {
            $this->tenant->run(function () use ($id) {
                $item = Addition::find($id);
                $this->name = $item->name;
                $this->active = $item->active;
                $this->price = (float)$item->price;
                $this->imagePath = isset($item->image) ? asset($item->image->file_path) : '';
                $this->item_id = $item->id;
            });

            $this->modalId = 'editAdditionItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateAdditionItem()
    {


        $this->validate();

        try {
            $this->tenant->run(function () {
                $item = Addition::find($this->item_id);
                $item->name = $this->name;
                $item->price = $this->price;
                $item->active = $this->active;
                $item->save();

                if ($this->image) {
                    $tenantId = $this->tenant->id;
                    $fileName = $this->image->getClientOriginalName();
                    $filePath = $this->image->storeAs(
                        "uploads/tenant/additions/{$tenantId}", // Path within storage
                        $fileName,
                        'public'
                    );
                    upload_tenant_file($filePath, 'App\Models\Addition', $item->id, $fileName, 'image');
                }
            });


            $this->close(__('msg.addition_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteAdditionConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteAdditionConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteAdditionItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Addition::find($this->item_id);
                if ($item)
                    $item->delete();
            });

            $this->close(__('msg.addition_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteAdditionsListConfirmation()
    {
        try {

            $this->modalId = 'deleteAdditionsListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }


    public function deleteAdditionsList()
    {

        try {
            $this->tenant->run(function () {
                Addition::whereIn('id', $this->additions_list)->delete();
            });

            $this->additions_list = [];
            $this->close(__('msg.additions_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function activeAdditionItem($id)
    {

        try {
            $this->tenant->run(function () use ($id) {
                $item = Addition::find($id);
                if ($item->active == 1)
                    $item->active = 0;
                else
                    $item->active = 1;
                $item->save();
            });

            $this->close(__('msg.addition_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Additions')]
    public function render()
    {
        $additions = null;
        $this->tenant->run(function () use (&$additions) {
            $additions = Addition::orderBy('id');
            if ($this->search)
                $additions = $additions->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                });
            if ($this->status == 1)
                $additions = $additions->where('active', 1);
            if ($this->status == 2)
                $additions = $additions->where('active', 0);

            $additions = $additions->paginate(10);
        });


        return view('livewire.dashboard.user.product.additions', [
            'additions' => $additions,
        ]);
    }

}
