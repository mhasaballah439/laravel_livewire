<?php

namespace App\Livewire\Dashboard\User\Product;

use App\Models\Tax;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Taxes extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $rate, $active, $item_id;

    public $search = '';
    public $status = '';
    public $tenant = '';
    public $modalId = '';
    public $taxes_list = [];

    protected $rules = [
        'name' => 'required',
        'rate' => 'required',
    ];

    public function mount($username)
    {
        $user = User::where('username', $username)->first();
        $this->tenant = Tenant::findOrFail($user->store_name);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->rate = '';
        $this->active = false;
        $this->item_id = null;
    }

    public function createTaxItem()
    {
        $this->resetFields();
        $this->modalId = 'addTaxItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }


    public function storeTaxItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {

            $this->tenant->run(function () {
                $item = new Tax();
                $item->name = $this->name;
                $item->rate = $this->rate;
                $item->active = $this->active;
                $item->save();
            });


            $this->resetFields();
            $this->close(__('msg.tax_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editTaxItem($id)
    {
        try {
            $this->tenant->run(function () use ($id) {
                $item = Tax::find($id);
                $this->name = $item->name;
                $this->rate = (float)$item->rate;
                $this->active = $item->active;
                $this->item_id = $item->id;
            });

            $this->modalId = 'editTaxItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateTaxItem()
    {


        $this->validate();

        try {
            $this->tenant->run(function () {
                $item = Tax::find($this->item_id);
                $item->name = $this->name;
                $item->rate = $this->rate;
                $item->active = $this->active;
                $item->save();
            });


            $this->close(__('msg.tax_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteTaxConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteTaxConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteTaxItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Tax::find($this->item_id);
                if ($item)
                    $item->delete();
            });

            $this->close(__('msg.tax_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteTaxesListConfirmation()
    {
        try {

            $this->modalId = 'deleteTaxesListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }


    public function deleteTaxesList()
    {

        try {
            $this->tenant->run(function () {
                Tax::whereIn('id', $this->taxes_list)->delete();
            });

            $this->taxes_list = [];
            $this->close(__('msg.taxes_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function activeTaxItem($id)
    {

        try {
            $this->tenant->run(function () use ($id) {
                $item = Tax::find($id);
                if ($item->active == 1)
                    $item->active = 0;
                else
                    $item->active = 1;
                $item->save();
            });

            $this->close(__('msg.tax_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Taxes')]
    public function render()
    {
        $taxes = null;
        $this->tenant->run(function () use (&$taxes) {
            $taxes = Tax::orderBy('id');
            if ($this->search)
                $taxes = $taxes->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                });
            if ($this->status == 1)
                $taxes = $taxes->where('active', 1);
            if ($this->status == 2)
                $taxes = $taxes->where('active', 0);

            $taxes = $taxes->paginate(10);
        });



        return view('livewire.dashboard.user.product.taxes', [
            'taxes' => $taxes,
        ]);
    }

}
