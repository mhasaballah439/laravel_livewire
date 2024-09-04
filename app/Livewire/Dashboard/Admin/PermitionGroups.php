<?php

namespace App\Livewire\Dashboard\Admin;

use App\Models\Link;
use App\Models\PermitionGroup;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PermitionGroups extends Component
{
    use WithPagination,WithoutUrlPagination;

    public $name,$is_default,$item_id;
    public $links = [];

    public $search = '';
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public $activeTab = 'border-navs-all';

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->links = [];
        $this->item_id = null;
        $this->is_default = false;
    }

    protected $rules = [
        'name' => 'required',
    ];

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
        $this->validate();
        $this->resetErrorBag();

        try {
            $group = new PermitionGroup();
            $group->name = $this->name;
            $group->is_default = $this->is_default;
            $group->links = json_encode($this->links);
            $group->save();

            $this->resetFields();
            $this->close();

        } catch (Exception $e) {
            // Error response
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


    }

    public function editItem($id)
    {
        $group = PermitionGroup::find($id);
        try {
            $this->name = $group->name;
            $this->is_default = $group->is_default;
            $this->links = json_decode($group->links);
            $this->item_id = $group->id;

            $this->dispatch('edit-item');
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function updateItem()
    {
        $this->validate();

        $group = PermitionGroup::find($this->item_id);
        try {

          $group->name = $this->name;
          $group->is_default = $this->is_default;
          $group->links = json_encode($this->links);
          $group->save();

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
        $group = PermitionGroup::find($this->item_id);
        try {
            $group->delete();

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
        $group = PermitionGroup::onlyTrashed()->where('id',$this->item_id)->first();
        try {
            $group->restore();

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
        $group = PermitionGroup::withTrashed()->where('id',$this->item_id)->first();
        try {
            $group->forceDelete();

            $this->close();
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    #[Title('Permition groups')]
    public function render()
    {
        $groups = PermitionGroup::where('name','LIKE','%'.$this->search.'%')
            ->paginate(10);

        $deleted_groups = PermitionGroup::onlyTrashed()->paginate(10);

        $urls = Link::get();

        return view('livewire.dashboard.admin.permition-groups',[
            'groups' => $groups,
            'deleted_groups' => $deleted_groups,
            'urls' => $urls,
        ]);
    }
}
