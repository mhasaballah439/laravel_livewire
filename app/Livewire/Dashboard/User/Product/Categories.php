<?php

namespace App\Livewire\Dashboard\User\Product;

use App\Models\Category;
use App\Models\Language;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $name, $slug, $active, $active_in_menu, $image, $imagePath, $item_id
    , $seo_title, $seo_desc, $seo_keywords;

    public $search = '';
    public $status = '';
    public $tenant = '';
    public $modalId = '';
    public $category_list = [];
    public $locals = [];

    protected $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    public function mount($username)
    {
        $user = User::where('username', $username)->first();
        $this->tenant = Tenant::findOrFail($user->store_name);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->active_in_menu = false;
        $this->seo_title = '';
        $this->seo_desc = '';
        $this->seo_keywords = '';
        $this->image = '';
        $this->locals = [];
        $this->active = false;
        $this->item_id = null;
    }

    public function createCategoryItem()
    {
        $this->resetFields();
        $this->modalId = 'addCategoryItemModal';
        $this->dispatch('open-modal', modalId: $this->modalId);
    }

    public function close($msg)
    {
        $this->dispatch('close', message: $msg, modalId: $this->modalId);
    }


    public function storeCategoryItem()
    {
        $this->validate();
        $this->resetErrorBag();

        try {

            $this->tenant->run(function () {
                $item = new Category();
                $item->name = $this->name;
                $item->slug = $this->slug;
                $item->active_in_menu = $this->active_in_menu;
                $item->seo_title = $this->seo_title;
                $item->seo_desc = $this->seo_desc;
                $item->seo_keywords = $this->seo_keywords;
                $item->active = $this->active;
                $item->save();

                if ($this->locals)
                    add_locals('App\Models\Category',$item->id,json_encode($this->locals));

                if ($this->image) {
                    $tenantId = $this->tenant->id;
                    $fileName = $this->image->getClientOriginalName();

                    $filePath = $this->image->storeAs(
                        "uploads/tenant/Categories/{$tenantId}",
                        $fileName,
                        'public'
                    );

                    upload_tenant_file($filePath, 'App\Models\Category', $item->id, $fileName, 'image');
                }
            });


            $this->resetFields();
            $this->close(__('msg.category_add_successfully'));

        } catch (Exception $e) {
            $this->dispatch('catch-error', message: $e->getMessage());
        }


    }

    public function editCategoryItem($id)
    {
        try {
            $this->tenant->run(function () use ($id) {
                $item = Category::find($id);
                $this->name = $item->name;
                $this->active = $item->active;
                $this->slug = $item->slug;
                $this->active_in_menu = $item->active_in_menu;
                $this->seo_title = $item->seo_title;
                $this->seo_desc = $item->seo_desc;
                $this->seo_keywords = $item->seo_keywords;
                $this->locals = isset($item->transalte) ? json_decode($item->transalte->text) : [];
                $this->imagePath = isset($item->image) ? asset($item->image->file_path) : '';
                $this->item_id = $item->id;
            });

            $this->modalId = 'editCategoryItemModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function updateCategoryItem()
    {


        $this->validate();

        try {
            $this->tenant->run(function () {
                $item = Category::find($this->item_id);
                $item->name = $this->name;
                $item->slug = $this->slug;
                $item->active_in_menu = $this->active_in_menu;
                $item->seo_title = $this->seo_title;
                $item->seo_desc = $this->seo_desc;
                $item->seo_keywords = $this->seo_keywords;
                $item->active = $this->active;
                $item->save();

                if ($this->locals)
                    add_locals('App\Models\Category',$item->id,json_encode($this->locals));

                if ($this->image) {
                    $tenantId = $this->tenant->id;
                    $fileName = $this->image->getClientOriginalName();
                    $filePath = $this->image->storeAs(
                        "uploads/tenant/Categories/{$tenantId}", // Path within storage
                        $fileName,
                        'public'
                    );
                    upload_tenant_file($filePath, 'App\Models\Category', $item->id, $fileName, 'image');
                }
            });


            $this->close(__('msg.category_updated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteCategoryConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'deleteCategoryConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function deleteCategoryItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Category::find($this->item_id);
                if ($item)
                    $item->delete();
            });

            $this->close(__('msg.category_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function forceDeleteCategoryConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'forceDeleteCategoryConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function forceDeleteCategoryItem()
    {
        try {
            $this->tenant->run(function () {
                $item = Category::withTrashed()->where('id',$this->item_id)->first();
                if ($item)
                    $item->forceDelete();
            });

            $this->close(__('msg.category_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function restoreCategoryConfirmation($id)
    {
        try {
            $this->item_id = $id;

            $this->modalId = 'restoreCategoryConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }

    public function restoreCategoryItem()
    {
        $item = Category::onlyTrashed()->where('id',$this->item_id)->first();
        try {
            $item->restore();

            $this->close(__('msg.category_restored_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message:$e->getMessage());
        }
    }
    public function deleteCategoryListConfirmation()
    {
        try {

            $this->modalId = 'deleteCategoryListConfrmationModal';

            $this->dispatch('open-modal', modalId: $this->modalId);
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }


    public function deleteCategoryList()
    {

        try {
            $this->tenant->run(function () {
                Category::whereIn('id', $this->category_list)->delete();
            });

            $this->category_list = [];
            $this->close(__('msg.categorys_deleted_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    public function activeCategoryItem($id)
    {

        try {
            $this->tenant->run(function () use ($id) {
                $item = Category::find($id);
                if ($item->active == 1)
                    $item->active = 0;
                else
                    $item->active = 1;
                $item->save();
            });

            $this->close(__('msg.category_activated_successfully'));
        } catch (Exception $e) {

            $this->dispatch('catch-error', message: $e->getMessage());
        }
    }

    #[Title('Categories')]
    public function render()
    {
        $categories = null;
        $languages = null;
        $this->tenant->run(function () use (&$categories,&$languages) {
            $categories = Category::orderBy('id');
            if ($this->search)
                $categories = $categories->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%');
                });
            if ($this->status == 1)
                $categories = $categories->where('active', 1);
            if ($this->status == 2)
                $categories = $categories->where('active', 0);
            if ($this->status == 3)
                $categories = $categories->onlyTrashed();

            $categories = $categories->paginate(10);
            $languages = Language::Active()->get();
        });


        return view('livewire.dashboard.user.product.categories', [
            'categories' => $categories,
            'languages' => $languages,
        ]);
    }

}
