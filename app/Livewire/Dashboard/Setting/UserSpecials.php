<?php

namespace App\Livewire\Dashboard\Setting;

use App\Exports\UserSpecialsExport;
use App\Imports\UserSpecialsImport;
use App\Models\Language;
use App\Models\UserSpecial;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UserSpecials extends Component
{
    use WithPagination, WithoutUrlPagination,WithFileUploads;

    public $name, $active, $item_id,$excel_file;

    public $search = '';
    public $modalId = '';
    public $list = [];
    public $locals = [];

    protected $rules = [
        'name' => 'required',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->active = false;
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

        try {
            $item = new UserSpecial();
            $item->name = $this->name;
            $item->active = $this->active;
            $item->save();

            add_locals('App\Models\UserSpecial',$item->id,json_encode($this->locals));

            $this->resetFields();
            $this->close(__('msg.special_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editItem($id)
    {
        $item = UserSpecial::find($id);
        try {
            $this->name = $item->name;
            $this->active = $item->active;
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
        $item = UserSpecial::find($this->item_id);
        $this->validate();

        try {

            $item->name = $this->name;
            $item->active = $this->active;
            $item->save();


            add_locals('App\Models\UserSpecial',$item->id,json_encode($this->locals));

            $this->close(__('msg.special_updated_successfully'));
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
        $item = UserSpecial::find($this->item_id);
        try {
            $item->delete();

            $this->close(__('msg.special_deleted_successfully'));
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
            UserSpecial::whereIn('id',$this->list)->delete();
            $this->list = [];
            $this->close(__('msg.special_deleted_successfully'));
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
            Excel::import(new UserSpecialsImport(), $filePath);
            $this->close(__('msg.special_imported_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new UserSpecialsExport(), 'special_export_' . date('d_m_Y') . '.xlsx');
    }
    public function activeItem($id)
    {
        $item = UserSpecial::find($id);
        try {
            if ($item->active == 1)
                $item->active = 0;
            else
                $item->active = 1;
            $item->save();

            $this->close(__('msg.special_activeated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Specials')]
    public function render()
    {
        $items = UserSpecial::where(function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(10);

        $languages = Language::Active()->get();
        return view('livewire.dashboard.setting.user-specials', [
            'items' => $items,
            'languages' => $languages,
        ]);
    }

}
