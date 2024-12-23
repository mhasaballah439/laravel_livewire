<?php

namespace App\Livewire\Dashboard\Setting;

use App\Exports\LanguagesExport;
use App\Imports\LanguagesImport;
use App\Models\Language;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Languages extends Component
{
    use WithPagination, WithoutUrlPagination,WithFileUploads;

    public $name, $code, $active,$is_default, $item_id,$excel_file;

    public $search = '';
    public $modalId = '';
    public $list = [];

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
            DB::table('languages')->where('is_default',1)->update(['is_default' => 0]);
        try {
            $item = new Language();
            $item->name = $this->name;
            $item->code = $this->code;
            $item->active = $this->active;
            $item->is_default = $this->is_default;
            $item->save();

            $this->resetFields();
            $this->close(__('msg.language_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editItem($id)
    {
        $item = Language::find($id);
        try {
            $this->name = $item->name;
            $this->code = $item->code;
            $this->active = $item->active;
            $this->is_default = $item->is_default;
            $this->item_id = $item->id;

            $this->modalId = 'editItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateItem()
    {
        $item = Language::find($this->item_id);
        $this->validate();

        try {
            if ($this->is_default == 1)
                DB::table('languages')->where('is_default',1)->update(['is_default' => 0]);
            $item->name = $this->name;
            $item->code = $this->code;
            $item->active = $this->active;
            $item->is_default = $this->is_default;
            $item->save();


            $this->close(__('msg.language_updated_successfully'));
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
        $item = Language::find($this->item_id);
        try {
            $item->delete();

            $this->close(__('msg.language_deleted_successfully'));
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
            Language::whereIn('id',$this->list)->delete();
            $this->list = [];
            $this->close(__('msg.language_deleted_successfully'));
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
            Excel::import(new LanguagesImport(), $filePath);
            $this->close(__('msg.language_imported_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new LanguagesExport(), 'languages_export_' . date('d_m_Y') . '.xlsx');
    }
    public function activeItem($id)
    {
        $item = Language::find($id);
        try {
            if ($item->active == 1)
                $item->active = 0;
            else
                $item->active = 1;
            $item->save();

            $this->close(__('msg.language_activeated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Languages')]
    public function render()
    {
        $items = Language::where(function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.dashboard.setting.languages', [
            'items' => $items,
        ]);
    }

}
