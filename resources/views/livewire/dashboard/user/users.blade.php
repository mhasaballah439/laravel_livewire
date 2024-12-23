<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{__('msg.owners')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                           wire:navigate>{{__('msg.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('msg.owners')}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="customerList">
                    <div class="modal fade" wire:ignore.self id="deleteConfrmationModal" aria-hidden="true"
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
                                            <button class="btn btn-primary" wire:click="deleteItem">
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
                    <div class="modal fade" wire:ignore.self id="forceDeleteConfrmationModal" aria-hidden="true"
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
                                            <button class="btn btn-primary" wire:click="forceDelete">
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
                    <div class="modal fade" wire:ignore.self id="restoreConfrmationModal" aria-hidden="true"
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
                                            <button class="btn btn-primary" wire:click="restoreItem">
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

                    <div class="modal fade" wire:ignore.self id="deleteListConfrmationModal" aria-hidden="true"
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
                                            <button class="btn btn-primary" wire:click="deleteList">
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
                    <div class="modal fade" wire:ignore.self id="addItemModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">{{__('msg.add_new_owner')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="storeItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
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

                                                    <!--end col-->
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
                                                            <label for="store_name"
                                                                   class="form-label">{{__('msg.store_name')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="store_name"
                                                                       @error('store_name') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="store_name"
                                                                       placeholder="{{__('msg.enter_store_name')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('store_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="email"
                                                                   class="form-label">{{__('msg.email')}}</label>
                                                            <div class="form-icon">
                                                                <input type="email" wire:model="email"
                                                                       @error('email') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="email"
                                                                       placeholder="{{__('msg.enter_email')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-record-mail-fill"></i>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="phone"
                                                                   class="form-label">{{__('msg.phone')}}</label>
                                                            <div class="form-icon">
                                                                <input type="tel" wire:model="phone"
                                                                       @error('phone') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="phone"
                                                                       placeholder="{{__('msg.enter_phone')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-numbers-fill"></i>
                                                            </div>
                                                            @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="password"
                                                                   class="form-label">{{__('msg.password')}}</label>
                                                            <div class="form-icon">
                                                                <input type="password" wire:model="password"
                                                                       @error('password') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="password"
                                                                       placeholder="{{__('msg.enter_password')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-lock-fill"></i>
                                                            </div>
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.language')}}</label>
                                                            <select wire:model="default_lang_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('default_lang_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_language')}}</option>
                                                                @if($languages && count($languages) > 0)
                                                                    @foreach($languages as $language)
                                                                        <option
                                                                            value="{{ $language->id}}">{{ $language->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('default_lang_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.currency')}}</label>
                                                            <select wire:model="currency_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('currency_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_currency')}}</option>
                                                                @if($currencies && count($currencies) > 0)
                                                                    @foreach($currencies as $currency)
                                                                        <option
                                                                            value="{{ $currency->id}}">{{ $currency->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('currency_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.special')}}</label>
                                                            <select wire:model="special_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('special_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_special')}}</option>
                                                                @if($specials && count($specials) > 0)
                                                                    @foreach($specials as $special)
                                                                        <option
                                                                            value="{{ $special->id}}">{{ $special->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('special_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                    <div class="modal fade" wire:ignore.self id="editItemModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">{{__('msg.edit_owner')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="updateItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
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

                                                    <!--end col-->
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
                                                            <label for="store_name"
                                                                   class="form-label">{{__('msg.store_name')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="store_name"
                                                                       @error('store_name') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="store_name"
                                                                       placeholder="{{__('msg.enter_store_name')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('store_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="email"
                                                                   class="form-label">{{__('msg.email')}}</label>
                                                            <div class="form-icon">
                                                                <input type="email" wire:model="email"
                                                                       @error('email') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="email"
                                                                       placeholder="{{__('msg.enter_email')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-record-mail-fill"></i>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="phone"
                                                                   class="form-label">{{__('msg.phone')}}</label>
                                                            <div class="form-icon">
                                                                <input type="tel" wire:model="phone"
                                                                       @error('phone') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="phone"
                                                                       placeholder="{{__('msg.enter_phone')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-numbers-fill"></i>
                                                            </div>
                                                            @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="password"
                                                                   class="form-label">{{__('msg.password')}}</label>
                                                            <div class="form-icon">
                                                                <input type="password" wire:model="password"
                                                                       @error('password') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="password"
                                                                       placeholder="{{__('msg.enter_password')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-lock-fill"></i>
                                                            </div>
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.language')}}</label>
                                                            <select wire:model="default_lang_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('default_lang_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_language')}}</option>
                                                                @if($languages && count($languages) > 0)
                                                                    @foreach($languages as $language)
                                                                        <option
                                                                            value="{{ $language->id}}">{{ $language->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('default_lang_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.currency')}}</label>
                                                            <select wire:model="currency_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('currency_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_currency')}}</option>
                                                                @if($currencies && count($currencies) > 0)
                                                                    @foreach($currencies as $currency)
                                                                        <option
                                                                            value="{{ $currency->id}}">{{ $currency->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('currency_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="iconInput"
                                                                   class="form-label">{{__('msg.special')}}</label>
                                                            <select wire:model="special_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('special_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                <option value="">{{__('msg.select_special')}}</option>
                                                                @if($specials && count($specials) > 0)
                                                                    @foreach($specials as $special)
                                                                        <option
                                                                            value="{{ $special->id}}">{{ $special->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('special_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                                        <h5 class="card-title mb-0">{{__('msg.owners')}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div>
                                        <button class="btn btn-danger cursor-pointer"
                                                wire:click="deleteListConfirmation"
                                                :disabled="!hasSelected">
                                            <i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn cursor-pointer"
                                                wire:click="createItem()">
                                            <i class="ri-add-line align-bottom me-1"></i>{{__('msg.add_owner')}}
                                        </button>

                                        <button type="button" wire:loading.remove wire:click="export"
                                                class="btn btn-warning cursor-pointer "><i
                                                class="ri-file-excel-2-line align-bottom me-1"></i>
                                            {{__('msg.export')}}</button>
                                        <div wire:loading wire:target="export">
                                                            <span class="spinner-border spinner-border-sm" role="status"
                                                                  aria-hidden="true"></span>
                                            {{__('msg.file_pressing')}}...
                                        </div>
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
                                    <div class="col-md-3">
                                        <div>
                                            <select wire:model="search_special" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('search_special', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                <option value="">{{__('msg.reset_select')}}</option>
                                                @if($specials && count($specials) > 0)
                                                    @foreach($specials as $special)
                                                        <option
                                                            value="{{ $special->id}}">{{ $special->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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
                                    @if($items && count($items) > 0)
                                        <table class="table align-middle" id="customerTable">
                                            <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    #
                                                </th>
                                                <th class="text-center">{{__('msg.username')}}</th>
                                                <th class="text-center">{{__('msg.image')}}</th>
                                                <th class="text-center">{{__('msg.name')}}</th>
                                                <th class="text-center">{{__('msg.domain')}}</th>
                                                <th class="text-center">{{__('msg.store_name')}}</th>
                                                <th class="text-center">{{__('msg.special')}}</th>
                                                <th class="text-center">{{__('msg.email')}}</th>
                                                <th class="text-center">{{__('msg.phone')}}</th>
                                                <th class="text-center">{{__('msg.active')}}</th>
                                                <th class="text-center">{{__('msg.action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input row-checkbox"
                                                                type="checkbox"
                                                                wire:model.defer="list"
                                                                value="{{ $item->id }}"
                                                                @change="updateHasSelected">
                                                        </div>
                                                    </th>
                                                    <td class="text-center">{{ $item->username }}</td>
                                                    <td class="text-center">
                                                        <img
                                                            src="{{isset($item->image) ? asset($item->image->file_path) : ''}}"
                                                            alt="image" width="50px">
                                                    </td>
                                                    <td class="text-center">{{ $item->name ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{$item->domain}}" class="text-decoration-none" target="_blank">{{$item->domain}}</a>
                                                    </td>
                                                    <td class="text-center">{{ $item->store_name ?? '-' }}</td>
                                                    <td class="text-center">{{ $item->special->name ?? '-' }}</td>
                                                    <td class="text-center">{{ $item->email ?? '-' }}</td>
                                                    <td class="text-center">{{ $item->phone ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <div class="form-check form-switch text-center">
                                                            <input
                                                                class="form-check-input"
                                                                wire:change="activeItem({{ $item->id }})"
                                                                type="checkbox"
                                                                {{ $item->active == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->trashed())
                                                            <a wire:click="restoreConfirmation({{ $item->id }})" class="text-primary mr-2 cursor-pointer">
                                                                <i class="ri-delete-back-fill fs-20"></i>
                                                            </a>
                                                            <a wire:click="forceDeleteConfirmation({{ $item->id }})" class="text-danger ml-2 cursor-pointer">
                                                                <i class="ri-delete-row fs-20"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{route('dashboard.user_details',$item->username)}}"
                                                               wire:navigate
                                                               class="text-warning mr-2 cursor-pointer">
                                                                <i class="ri-eye-fill fs-20"></i>
                                                            </a>
                                                            <a wire:click="editItem({{ $item->id }})"
                                                               class="text-primary mr-2 cursor-pointer">
                                                                <i class="ri-pencil-fill fs-20"></i>
                                                            </a>
                                                            <a wire:click="deleteConfirmation({{ $item->id }})"
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
                                            {{$items->links()}}
                                        </div>
                                    @else

                                        <livewire:dashboard.partials.notresult/>
                                </div>

                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
    </div>
</div>
@script
<script>
    $wire.on('close', (data) => {
        var itemModal = document.getElementById(data.modalId)
        var modal = bootstrap.Modal.getInstance(itemModal)
        modal.hide();

        Toastify({
            text: data.message,
            position: "center",
            close: true,
        }).showToast();
    });
    $wire.on('open-modal', (data) => {
        var modal = new bootstrap.Modal(document.getElementById(data.modalId)).show();
    });
    $wire.on('catch-error', (data) => {
        Toastify({
            text: data.message,
            position: "center",
            close: true,
            style: {
                background: "#ff2d2d",
            }
        }).showToast();
    });

</script>

@endscript
@push('scripts')
    <script>
        function tableHandler() {
            return {
                checkAll: false,
                hasSelected: false,
                updateHasSelected() {
                    // Check if at least one checkbox is selected
                    this.hasSelected = document.querySelectorAll('.row-checkbox:checked').length > 0;

                    // Sync `checkAll` state based on the individual checkboxes
                    const checkboxes = document.querySelectorAll('.row-checkbox');
                    const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
                    this.checkAll = checkboxes.length === checkedCheckboxes.length;
                }
            };
        }
    </script>
@endpush
