<?php

namespace App\Livewire\Dashboard\User\Product;

use App\Models\Brand;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $active, $item_id;

    public $search = '';
    public $status = '';
    public $tenant = '';
    public $modalId = '';
    public $brands_list = [];

    protected $rules = [
        'name' => 'required',
    ];

    public function mount($username)
    {
        $user = User::where('username', $username)->first();
        $this->tenant = Tenant::findOrFail($user->store_name);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->active = false;
        $this->item_id = null;
    }

    public function createBrandItem()
    {
        $this->resetFields();
        $this->modalId = 'addBrandItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }


    public function storeBrandItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {

            $this->tenant->run(function () {
                $item = new Brand();
                $item->name = $this->name;
                $item->active = $this->active;
                $item->save();
            });


            $this->resetFields();
            $this->close(__('msg.brand_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editBrandItem($id)
    {
        try {
            $this->tenant->run(function () use ($id) {
                $item = Brand::find($id);
                $this->name = $item->name;
                $this->active = $item->active;
                $this->item_id = $item->id;
            });

            $this->modalId = 'editBrandItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateBrandItem()
    {


        $this->validate();

        try {
            $this->tenant->run(function () {
                $item = Brand::find($this->item_id);
                $item->name = $this->name;
                $item->active = $this->active;
                $item->save();
            });


            $this->close(__('msg.brand_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteBrandConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteBrandConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteBrandItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Brand::find($this->item_id);
                if ($item)
                    $item->delete();
            });

            $this->close(__('msg.brand_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteBrandsListConfirmation()
    {
        try {

            $this->modalId = 'deleteBrandsListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }


    public function deleteBrandsList()
    {

        try {
            $this->tenant->run(function () {
                Brand::whereIn('id', $this->brands_list)->delete();
            });

            $this->brands_list = [];
            $this->close(__('msg.brands_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function activeBrandItem($id)
    {

        try {
            $this->tenant->run(function () use ($id) {
                $item = Brand::find($id);
                if ($item->active == 1)
                    $item->active = 0;
                else
                    $item->active = 1;
                $item->save();
            });

            $this->close(__('msg.brand_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Brands')]
    public function render()
    {
        $brands = null;
        $this->tenant->run(function () use (&$brands) {
            $brands = Brand::orderBy('id');
            if ($this->search)
                $brands = $brands->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                });
            if ($this->status == 1)
                $brands = $brands->where('active', 1);
            if ($this->status == 2)
                $brands = $brands->where('active', 0);

            $brands = $brands->paginate(10);
        });


        return view('livewire.dashboard.user.product.brands', [
            'brands' => $brands,
        ]);
    }

}
