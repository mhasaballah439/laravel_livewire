<div>

    <div class="modal fade" wire:ignore.self id="deleteCategoryConfrmationModal" aria-hidden="true"
         aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon
                        src="https://cdn.lordicon.com/tdrtiskw.json"
                        trigger="loop"
                        colors="primary:#f7b84b,secondary:#405189"
                        style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-4 pt-4">
                        <h4>
                            {{__('msg.confirm_delete')}}
                        </h4>
                        <!-- Toogle to second dialog -->
                        <div class="buttons_modal mt-3">
                            <button class="btn btn-primary" wire:click="deleteCategoryItem">
                                {{__('msg.continue')}}
                            </button>
                            <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">{{__('msg.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="deleteCategoryListConfrmationModal" aria-hidden="true"
         aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon
                        src="https://cdn.lordicon.com/tdrtiskw.json"
                        trigger="loop"
                        colors="primary:#f7b84b,secondary:#405189"
                        style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-4 pt-4">
                        <h4>
                            {{__('msg.confirm_list_delete')}}
                        </h4>
                        <!-- Toogle to second dialog -->
                        <div class="buttons_modal mt-3">
                            <button class="btn btn-primary" wire:click="deleteCategoryList">
                                {{__('msg.continue')}}
                            </button>
                            <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">{{__('msg.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="forceDeleteCategoryConfrmationModal" aria-hidden="true"
         aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon
                        src="https://cdn.lordicon.com/gsqxdxog.json"
                        trigger="loop"
                        colors="primary:#f7b84b,secondary:#405189"
                        style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-4 pt-4">
                        <h4>
                            {{__('msg.confirm_force_delete')}}
                        </h4>
                        <!-- Toogle to second dialog -->
                        <div class="buttons_modal mt-3">
                            <button class="btn btn-primary" wire:click="forceDeleteCategoryItem">
                                {{__('msg.continue')}}
                            </button>
                            <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">{{__('msg.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="restoreCategoryConfrmationModal" aria-hidden="true"
         aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon
                        src="https://cdn.lordicon.com/lupuorrc.json"
                        trigger="loop"
                        colors="primary:#f7b84b,secondary:#405189"
                        style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-4 pt-4">
                        <h4>
                            {{__('msg.confirm_restore')}}
                        </h4>
                        <!-- Toogle to second dialog -->
                        <div class="buttons_modal mt-3">
                            <button class="btn btn-primary" wire:click="restoreCategoryItem">
                                {{__('msg.continue')}}
                            </button>
                            <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">{{__('msg.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="addCategoryItemModal" aria-hidden="true" aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{__('msg.add_new_category')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="card-body">
                        <form wire:submit.prevent="storeCategoryItem">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <!--end col-->
                                    <div class="col-xxl-12 col-md-12">
                                        <div
                                            x-data="{
            imagePreview: @entangle('imagePath').live,
            handleFileUpload() {
                const file = this.$refs.fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result; // Set the image preview
                    };
                    reader.readAsDataURL(file); // Convert the file to base64 string
                } else {
                    this.imagePreview = ''; // Clear preview if no file
                }
            }
        }"
                                            class="text-center">

                                            <!-- Image Preview Section -->
                                            <div class="mb-3">
                                                <img
                                                    :src="imagePreview"
                                                    x-show="imagePreview"
                                                    class="img-thumbnail"
                                                    width="100"
                                                    height="100"
                                                    alt="Profile Image Preview">
                                            </div>

                                            <!-- File Input Section -->
                                            <div class="mb-3">
                                                <input
                                                    type="file"
                                                    wire:model="image"
                                                    x-ref="fileInput"
                                                    @change="handleFileUpload"
                                                    class="form-control"
                                                    accept="image/*">

                                                <!-- Loading Indicator -->
                                                <div wire:loading wire:target="image">
                                                                    <span class="spinner-border spinner-border-sm"
                                                                          role="status" aria-hidden="true"></span>
                                                    {{ __('msg.file_pressing') }}...
                                                </div>
                                            </div>

                                            <!-- Validation Error -->
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="name"
                                                   class="form-label">{{__('msg.name')}}</label>
                                            <div class="form-icon">
                                                <input type="text" wire:model="name"
                                                       @error('name') is-invalid @enderror
                                                       class="form-control form-control-icon"
                                                       id="name" placeholder="{{__('msg.enter_name')}}"
                                                       autocomplete="off">
                                                <i class=" ri-file-text-line"></i>
                                            </div>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="slug"
                                                   class="form-label">{{__('msg.slug')}}</label>
                                            <div class="form-icon">
                                                <input type="text" wire:model="slug"
                                                       @error('slug') is-invalid @enderror
                                                       class="form-control form-control-icon"
                                                       id="slug" placeholder="{{__('msg.enter_slug')}}"
                                                       autocomplete="off">
                                                <div  class="form-text">
                                                    http://.../categories/
                                                </div>
                                                <i class=" ri-file-text-line"></i>
                                            </div>
                                            @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-6">
                                        <label for="active_in_menu">{{__('msg.active_in_menu')}}</label>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" wire:model="active_in_menu"
                                                   type="checkbox" role="switch"
                                                   id="active_in_menu">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="active">{{__('msg.active')}}</label>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" wire:model="active"
                                                   type="checkbox" role="switch"
                                                   id="active">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-12">
                                        <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                   data-bs-toggle="tab" href="#border-navs-translate"
                                                   role="tab">{{__('msg.translate')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-bs-toggle="tab" href="#border-navs-seo"
                                                   role="tab">{{__('msg.seo')}}</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="border-navs-translate" role="tabpanel">
                                                <div class="row">
                                                    @if($languages && count($languages) > 0)
                                                        @foreach($languages as $lang)
                                                            <div class="col-xxl-3 col-md-6">
                                                                <div>
                                                                    <label for="locals_{{$lang->code}}"
                                                                           class="form-label">{{$lang->name}} ({{$lang->code}})</label>
                                                                    <div class="form-icon">
                                                                        <input type="text" wire:model="locals.{{$lang->code}}"
                                                                               class="form-control form-control-icon"
                                                                               id="locals_{{$lang->code}}" placeholder="{{__('msg.enter_name')}}"
                                                                               autocomplete="off">
                                                                        <i class=" ri-file-text-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane active" id="border-navs-seo" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_title"
                                                                   class="form-label">{{__('msg.seo_title')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="seo_title"
                                                                       @error('seo_title') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="seo_title" placeholder="{{__('msg.enter_seo_title')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('seo_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_title"
                                                                   class="form-label">{{__('msg.seo_desc')}}</label>
                                                            <div class="form-icon">
                                                                <textarea rows="3" wire:model="seo_desc"
                                                                       @error('seo_desc') is-invalid @enderror
                                                                       class="form-control"
                                                                       id="seo_desc" placeholder="{{__('msg.enter_seo_desc')}}"
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                            @error('seo_desc')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_keywords"
                                                                   class="form-label">{{__('msg.seo_keywords')}}</label>
                                                            <div class="form-icon">
                                                                <textarea rows="3" wire:model="seo_keywords"
                                                                       @error('seo_keywords') is-invalid @enderror
                                                                       class="form-control"
                                                                       id="seo_keywords" placeholder="{{__('msg.enter_seo_keywords')}}"
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                            @error('seo_keywords')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="buttons" style="margin-top: 15px;">
                                    <button type="submit"
                                            class="btn btn-primary bg-gradient waves-effect waves-light">{{__('msg.save')}}</button>
                                    <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">{{__('msg.close')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="editCategoryItemModal" aria-hidden="true" aria-labelledby="..."
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{__('msg.edit_category')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="card-body">
                        <form wire:submit.prevent="updateCategoryItem">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <!--end col-->
                                    <div class="col-xxl-12 col-md-12">
                                        <div
                                            x-data="{
            imagePreview: @entangle('imagePath').live,
            handleFileUpload() {
                const file = this.$refs.fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result; // Set the image preview
                    };
                    reader.readAsDataURL(file); // Convert the file to base64 string
                } else {
                    this.imagePreview = ''; // Clear preview if no file
                }
            }
        }"
                                            class="text-center">

                                            <!-- Image Preview Section -->
                                            <div class="mb-3">
                                                <img
                                                    :src="imagePreview"
                                                    x-show="imagePreview"
                                                    class="img-thumbnail"
                                                    width="100"
                                                    height="100"
                                                    alt="Profile Image Preview">
                                            </div>

                                            <!-- File Input Section -->
                                            <div class="mb-3">
                                                <input
                                                    type="file"
                                                    wire:model="image"
                                                    x-ref="fileInput"
                                                    @change="handleFileUpload"
                                                    class="form-control"
                                                    accept="image/*">

                                                <!-- Loading Indicator -->
                                                <div wire:loading wire:target="image">
                                                                    <span class="spinner-border spinner-border-sm"
                                                                          role="status" aria-hidden="true"></span>
                                                    {{ __('msg.file_pressing') }}...
                                                </div>
                                            </div>

                                            <!-- Validation Error -->
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="name"
                                                   class="form-label">{{__('msg.name')}}</label>
                                            <div class="form-icon">
                                                <input type="text" wire:model="name"
                                                       @error('name') is-invalid @enderror
                                                       class="form-control form-control-icon"
                                                       id="name" placeholder="{{__('msg.enter_name')}}"
                                                       autocomplete="off">
                                                <i class=" ri-file-text-line"></i>
                                            </div>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="slug"
                                                   class="form-label">{{__('msg.slug')}}</label>
                                            <div class="form-icon">
                                                <input type="text" wire:model="slug"
                                                       @error('slug') is-invalid @enderror
                                                       class="form-control form-control-icon"
                                                       id="slug" placeholder="{{__('msg.enter_slug')}}"
                                                       autocomplete="off">
                                                <div  class="form-text">
                                                    http://.../categories/
                                                </div>
                                                <i class=" ri-file-text-line"></i>
                                            </div>
                                            @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-6">
                                        <label for="active_in_menu">{{__('msg.active_in_menu')}}</label>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" wire:model="active_in_menu"
                                                   type="checkbox" role="switch"
                                                   id="active_in_menu">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="active">{{__('msg.active')}}</label>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" wire:model="active"
                                                   type="checkbox" role="switch"
                                                   id="active">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-12">
                                        <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                   data-bs-toggle="tab" href="#border-navs-translate"
                                                   role="tab">{{__('msg.translate')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   data-bs-toggle="tab" href="#border-navs-seo"
                                                   role="tab">{{__('msg.seo')}}</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="border-navs-translate" role="tabpanel">
                                                <div class="row">
                                                    @if($languages && count($languages) > 0)
                                                        @foreach($languages as $lang)
                                                            <div class="col-xxl-3 col-md-6">
                                                                <div>
                                                                    <label for="locals_{{$lang->code}}"
                                                                           class="form-label">{{$lang->name}} ({{$lang->code}})</label>
                                                                    <div class="form-icon">
                                                                        <input type="text" wire:model="locals.{{$lang->code}}"
                                                                               class="form-control form-control-icon"
                                                                               id="locals_{{$lang->code}}" placeholder="{{__('msg.enter_name')}}"
                                                                               autocomplete="off">
                                                                        <i class=" ri-file-text-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane active" id="border-navs-seo" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_title"
                                                                   class="form-label">{{__('msg.seo_title')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="seo_title"
                                                                       @error('seo_title') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="seo_title" placeholder="{{__('msg.enter_seo_title')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('seo_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_title"
                                                                   class="form-label">{{__('msg.seo_desc')}}</label>
                                                            <div class="form-icon">
                                                                <textarea rows="3" wire:model="seo_desc"
                                                                          @error('seo_desc') is-invalid @enderror
                                                                          class="form-control"
                                                                          id="seo_desc" placeholder="{{__('msg.enter_seo_desc')}}"
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                            @error('seo_desc')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-4 col-md-12">
                                                        <div>
                                                            <label for="seo_keywords"
                                                                   class="form-label">{{__('msg.seo_keywords')}}</label>
                                                            <div class="form-icon">
                                                                <textarea rows="3" wire:model="seo_keywords"
                                                                          @error('seo_keywords') is-invalid @enderror
                                                                          class="form-control"
                                                                          id="seo_keywords" placeholder="{{__('msg.enter_seo_keywords')}}"
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                            @error('seo_keywords')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="buttons" style="margin-top: 15px;">
                                    <button type="submit"
                                            class="btn btn-primary bg-gradient waves-effect waves-light">{{__('msg.save')}}</button>
                                    <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">{{__('msg.close')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="tableHandler()" x-init="init()" class="table-responsive">

        <div class="card-header border-bottom-dashed">

            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">{{__('msg.categories')}}</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div>
                        <button class="btn btn-danger cursor-pointer"
                                wire:click="deleteCategoryListConfirmation"
                                :disabled="!hasSelected">
                            <i class="ri-delete-bin-2-line"></i></button>
                        <button type="button" class="btn btn-success add-btn cursor-pointer"
                                wire:click="createCategoryItem()">
                            <i class="ri-add-line align-bottom me-1"></i>{{__('msg.add_category')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom-dashed border-bottom">
            <form>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="search-box">
                            <input type="text" class="form-control search"
                                   x-data
                                   x-on:input.debounce.500ms="$wire.set('search', $event.target.value)"
                                   placeholder="{{__('msg.search')}}">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div>
                            <select class="form-control" wire:model="status"
                                    x-data
                                    x-on:input.debounce.500ms="$wire.set('status', $event.target.value)">
                                <option value="">{{__('msg.all')}}</option>
                                <option value="1">{{__('msg.active')}}</option>
                                <option value="2">{{__('msg.inactive')}}</option>
                                <option value="3">{{__('msg.deleted')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </form>
        </div>
        <div class="card-body">
            <div>
                <div class="table-responsive table-card mb-1">
                    @if($categories && count($categories) > 0)
                        <table class="table align-middle" id="customerTable">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    #
                                </th>
                                <th class="text-center">{{__('msg.image')}}</th>
                                <th class="text-center">{{__('msg.name')}}</th>
                                <th class="text-center">{{__('msg.active')}}</th>
                                <th class="text-center">{{__('msg.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input row-checkbox"
                                                type="checkbox"
                                                wire:model.defer="Categorys_list"
                                                value="{{ $category->id }}"
                                                @change="updateHasSelected">
                                        </div>
                                    </th>
                                    <td class="text-center">
                                        <img
                                            src="{{$category->image_path($tenant)}}"
                                            alt="image" width="50px">
                                    </td>
                                    <td class="text-center">{{ $category->name}}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch text-center">
                                            <input
                                                class="form-check-input"
                                                wire:change="activeCategoryItem({{ $category->id }})"
                                                type="checkbox"
                                                {{ $category->active == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->trashed())
                                            <a wire:click="restoreCategoryConfirmation({{ $category->id }})" class="text-primary mr-2 cursor-pointer">
                                                <i class="ri-delete-back-fill fs-20"></i>
                                            </a>
                                            <a wire:click="forceDeleteCategoryConfirmation({{ $category->id }})" class="text-danger ml-2 cursor-pointer">
                                                <i class="ri-delete-row fs-20"></i>
                                            </a>
                                        @else
                                        <a wire:click="editCategoryItem({{ $category->id }})"
                                           class="text-primary mr-2 cursor-pointer">
                                            <i class="ri-pencil-fill fs-20"></i>
                                        </a>
                                        <a wire:click="deleteCategoryConfirmation({{ $category->id }})"
                                           class="text-danger ml-2 cursor-pointer">
                                            <i class="ri-delete-bin-5-fill fs-20"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$categories->links()}}
                        </div>
                    @else

                        <livewire:dashboard.partials.notresult/>
                </div>

                @endif
            </div>

        </div>
    </div>
</div>
