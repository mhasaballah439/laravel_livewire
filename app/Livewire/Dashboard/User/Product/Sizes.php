<?php

namespace App\Livewire\Dashboard\User\Product;

use App\Models\Size;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Sizes extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $price, $active, $item_id;

    public $search = '';
    public $status = '';
    public $tenant = '';
    public $modalId = '';
    public $sizes_list = [];

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
        $this->active = false;
        $this->item_id = null;
    }

    public function createSizeItem()
    {
        $this->resetFields();
        $this->modalId = 'addSizeItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }


    public function storeSizeItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {

            $this->tenant->run(function () {
                $item = new Size();
                $item->name = $this->name;
                $item->price = $this->price;
                $item->active = $this->active;
                $item->save();
            });


            $this->resetFields();
            $this->close(__('msg.size_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editSizeItem($id)
    {
        try {
            $this->tenant->run(function () use ($id) {
                $item = Size::find($id);
                $this->name = $item->name;
                $this->active = $item->active;
                $this->price = (float)$item->price;
                $this->item_id = $item->id;
            });

            $this->modalId = 'editSizeItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateSizeItem()
    {


        $this->validate();

        try {
            $this->tenant->run(function () {
                $item = Size::find($this->item_id);
                $item->name = $this->name;
                $item->price = $this->price;
                $item->active = $this->active;
                $item->save();
            });


            $this->close(__('msg.size_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteSizeConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteSizeConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteSizeItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Size::find($this->item_id);
                if ($item)
                    $item->delete();
            });

            $this->close(__('msg.size_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteSizesListConfirmation()
    {
        try {

            $this->modalId = 'deleteSizesListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }


    public function deleteSizesList()
    {

        try {
            $this->tenant->run(function () {
                Size::whereIn('id', $this->sizes_list)->delete();
            });

            $this->sizes_list = [];
            $this->close(__('msg.sizes_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function activeSizeItem($id)
    {

        try {
            $this->tenant->run(function () use ($id) {
                $item = Size::find($id);
                if ($item->active == 1)
                    $item->active = 0;
                else
                    $item->active = 1;
                $item->save();
            });

            $this->close(__('msg.size_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Sizes')]
    public function render()
    {
        $sizes = null;
        $this->tenant->run(function () use (&$sizes) {
            $sizes = Size::orderBy('id');
            if ($this->search)
                $sizes = $sizes->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                });
            if ($this->status == 1)
                $sizes = $sizes->where('active', 1);
            if ($this->status == 2)
                $sizes = $sizes->where('active', 0);

            $sizes = $sizes->paginate(10);
        });


        return view('livewire.dashboard.user.product.sizes', [
            'sizes' => $sizes,
        ]);
    }

}
