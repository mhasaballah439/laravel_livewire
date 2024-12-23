<?php

namespace App\Livewire\Dashboard\Setting;

use App\Exports\CountriesExport;
use App\Imports\CountriesImport;
use App\Models\Country;
use App\Models\Language;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Countries extends Component
{
    use WithPagination, WithoutUrlPagination,WithFileUploads;

    public $name, $code, $active, $is_default, $item_id,$excel_file;

    public $search = '';
    public $modalId = '';
    public $list = [];
    public $locals = [];

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->code = '';
        $this->active = false;
        $this->is_default = false;
        $this->item_id = null;
        $this->locals = [];
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

    public function storeItem()
    {
        $this->validate();
        $this->resetErrorBag();

        if ($this->is_default == 1)
            DB::table('countries')->where('is_default',1)->update(['is_default' => 0]);
        try {
            $item = new Country();
            $item->name = $this->name;
            $item->code = $this->code;
            $item->active = $this->active;
            $item->is_default = $this->is_default;
            $item->save();

            add_locals('App\Models\Country',$item->id,json_encode($this->locals));

            $this->resetFields();
            $this->close(__('msg.country_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editItem($id)
    {
        $item = Country::find($id);
        try {
            $this->name = $item->name;
            $this->code = $item->code;
            $this->active = $item->active;
            $this->is_default = $item->is_default;
            $this->item_id = $item->id;
            $this->locals = isset($item->transalte) ? json_decode($item->transalte->text) : [];

            $this->modalId = 'editItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateItem()
    {
        $item = Country::find($this->item_id);
        $this->validate();

        try {
            if ($this->is_default == 1)
                DB::table('countries')->where('is_default',1)->update(['is_default' => 0]);

            $item->name = $this->name;
            $item->code = $this->code;
            $item->active = $this->active;
            $item->is_default = $this->is_default;
            $item->save();

            add_locals('App\Models\Country',$item->id,json_encode($this->locals));

            $this->close(__('msg.country_updated_successfully'));
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
        $item = Country::find($this->item_id);
        try {
            $item->delete();

            $this->close(__('msg.country_deleted_successfully'));
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

    public function deleteList()
    {

        try {
            Country::whereIn('id',$this->list)->delete();
            $this->list = [];
            $this->close(__('msg.country_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function importConfirmation()
    {
        try {

            $this->modalId = 'importModal';
            $this->reset('excel_file');
            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function import()
    {
        try {

            $this->validate([
                'excel_file' => 'required|mimes:xlsx,csv',
            ]);
            $filePath = $this->excel_file->store('temp');
            Excel::import(new CountriesImport(), $filePath);
            $this->close(__('msg.countries_imported_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new CountriesExport(), 'countries_export_' . date('d_m_Y') . '.xlsx');
    }
    public function activeItem($id)
    {
        $item = Country::find($id);
        try {
            if ($item->active == 1)
                $item->active = 0;
            else
                $item->active = 1;
            $item->save();

            $this->close(__('msg.country_activeated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('countries')]
    public function render()
    {
        $items = Country::where(function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(10);

        $languages = Language::Active()->get();
        return view('livewire.dashboard.setting.countries', [
            'items' => $items,
            'languages' => $languages,
        ]);
    }

}
