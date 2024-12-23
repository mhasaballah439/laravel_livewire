<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header" style="display: flex;align-items: center;justify-content: space-between;">
                        <h5 class="card-title mb-0">{{__('msg.admins')}}</h5>
                        <button wire:click="createItem"
                                class="btn rounded-pill btn-primary waves-effect waves-light la la-plus"
                        >
                        </button>
                    </div>

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


                    <div class="modal fade" wire:ignore.self id="addItemModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="storeItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <!--end col-->
                                                    <div class="col-xxl-12 col-md-12">
                                                        <input
                                                            type="file" wire:model.lazy="image"
                                                            @error('image') is-invalid
                                                            @enderror accept="image/*"
                                                            class="setting-logo-input form-control">
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.username')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="username"
                                                                       @error('username') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="username"
                                                                       placeholder="{{__('msg.enter_username')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.email')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="email"
                                                                       @error('email') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="email"
                                                                       placeholder="{{__('msg.enter_email')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-mail-fill"></i>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.phone')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="phone"
                                                                       @error('phone') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="phone"
                                                                       placeholder="{{__('msg.enter_phone')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-phone-fill"></i>
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
                                                                <i class="ri-lock-password-fill"></i>
                                                            </div>
                                                            @error('password')
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

                                                    <div class="row mt-4"
                                                         x-data="{ isSuper: @entangle('is_super').live }">
                                                        <div class="col-xxl-3 col-md-6">
                                                            <label for="is_super">{{__('msg.is_super')}}</label>
                                                            <div class="form-check form-switch text-center">
                                                                <input class="form-check-input" wire:model="is_super"
                                                                       @change="isSuper = $event.target.checked ? 1 : 0"
                                                                       type="checkbox" role="switch"
                                                                       id="is_super">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-3 col-md-6" x-show="isSuper == 0" x-cloak>
                                                            <div>
                                                                <label for="iconInput"
                                                                       class="form-label">{{__('msg.permition_group')}}</label>
                                                                <select wire:model="permition_group_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('permition_group_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                    <option value="">{{__('msg.select_permition_group')}}</option>
                                                                    @if($permissions && count($permissions) > 0)
                                                                        @foreach($permissions as $permission)
                                                                            <option
                                                                                value="{{ $permission->id}}">{{ $permission->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
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

                    <div class="modal fade" wire:ignore.self id="editItemModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="updateItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <!--end col-->
                                                    <div class="col-xxl-12 col-md-12 text-center">

                                                        @if ($imagePath)
                                                            <img src="{{ $imagePath }}" alt="Preview Image"
                                                                 width="80px">
                                                        @endif

                                                        <input
                                                            type="file" wire:model="image" @error('image') is-invalid
                                                            @enderror accept="image/*"
                                                            class="setting-logo-input form-control mt-1">
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.username')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="username"
                                                                       @error('nausernameme') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="username"
                                                                       placeholder="{{__('msg.enter_username')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.email')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="email"
                                                                       @error('email') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="email"
                                                                       placeholder="{{__('msg.enter_email')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-mail-fill"></i>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="name"
                                                                   class="form-label">{{__('msg.phone')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="phone"
                                                                       @error('phone') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="phone"
                                                                       placeholder="{{__('msg.enter_phone')}}"
                                                                       autocomplete="off">
                                                                <i class="ri-phone-fill"></i>
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
                                                                <i class="ri-lock-password-fill"></i>
                                                            </div>
                                                            @error('password')
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
                                                    <div class="row mt-4"
                                                         x-data="{ isSuper: @entangle('is_super').live }">
                                                        <div class="col-xxl-3 col-md-6">
                                                            <label for="is_super">{{__('msg.is_super')}}</label>
                                                            <div class="form-check form-switch text-center">
                                                                <input class="form-check-input" wire:model="is_super"
                                                                       @change="isSuper = $event.target.checked ? 1 : 0"
                                                                       type="checkbox" role="switch"
                                                                       id="is_super">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-3 col-md-6" x-show="isSuper == 0" x-cloak>
                                                            <div>
                                                                <label for="iconInput"
                                                                       class="form-label">{{__('msg.permition_group')}}</label>
                                                                <select wire:model="permition_group_id" x-data x-init="$nextTick(() => {
                                                                                const choices = new Choices($el, {
                                                                                        searchEnabled: true,
                                                                                     itemSelectText: '',
                                                                                        });
                                                                        $el.addEventListener('change', function (e) {
                                                                        $wire.set('permition_group_id', e.target.value);
                                                                            });
                                                                        })" id="choices-select">
                                                                    <option value="">{{__('msg.select_permition_group')}}</option>
                                                                    @if($permissions && count($permissions) > 0)
                                                                        @foreach($permissions as $permission)
                                                                            <option
                                                                                value="{{ $permission->id}}">{{ $permission->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
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

                    <div class="card-body">
                        <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'border-navs-all' ? 'active' : '' }}"
                                   wire:click="switchTab('border-navs-all')"
                                   data-bs-toggle="tab" href="#border-navs-all"
                                   role="tab">{{__('msg.admins')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'border-navs-deleted' ? 'active' : '' }}"
                                   wire:click="switchTab('border-navs-deleted')"
                                   data-bs-toggle="tab" href="#border-navs-deleted"
                                   role="tab">{{__('msg.deleted_admins')}}</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ $activeTab === 'border-navs-all' ? 'active' : '' }}"
                                 id="border-navs-all"
                                 role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="iconInput" class="form-label">{{__('msg.search')}}</label>
                                        <input x-data
                                               x-on:input.debounce.500ms="$wire.set('search', $event.target.value)"
                                               type="text" class="form-control"
                                               placeholder="{{__('msg.search')}}">
                                    </div>
                                </div>
                                <table class=" table table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{__('msg.image')}}</th>
                                        <th class="text-center">{{__('msg.name')}}</th>
                                        <th class="text-center">{{__('msg.username')}}</th>
                                        <th class="text-center">{{__('msg.email')}}</th>
                                        <th class="text-center">{{__('msg.phone')}}</th>
                                        <th class="text-center">{{__('msg.active')}}</th>
                                        <th class="text-center">{{__('msg.is_super')}}</th>
                                        <th class="text-center">{{__('msg.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($admins && count($admins) > 0)
                                        @foreach($admins as $item)
                                            <tr>
                                                <td class="text-center cursor-pointer">
                                                    {{$loop->iteration}}
                                                </td>
                                                <td class="text-center">
                                                    <img
                                                        src="{{isset($item->image) ? asset($item->image->file_path) : ''}}"
                                                        alt="image" width="50px">
                                                </td>
                                                <td class="text-center">{{$item->name}}</td>
                                                <td class="text-center">{{$item->username}}</td>
                                                <td class="text-center">{{$item->email}}</td>
                                                <td class="text-center">{{$item->phone}}</td>
                                                <td class="text-center">
                                                    @if($item->active == 1 )
                                                        <i class="ri-checkbox-circle-line text-success"></i>
                                                    @else
                                                        <i class=" ri-close-circle-line text-danger"></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->is_super == 1 )
                                                        <i class="ri-checkbox-circle-line text-success"></i>
                                                    @else
                                                        <i class=" ri-close-circle-line text-danger"></i>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <div
                                                        class="d-flex  gap-2 align-items-center justify-content-center">
                                                        <div class="edit">
                                                            <a wire:click="editItem({{$item->id}})" type="button"
                                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                                               title="تعديل"
                                                               class="btn btn-primary btn-icon waves-effect waves-light">
                                                                <i class=" ri-edit-line"></i></a>
                                                        </div>
                                                        <div class="remove">

                                                            <button wire:click="deleteConfirmation({{$item->id}})"
                                                                    type="button"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="حذف"
                                                                    class="btn btn-danger btn-icon waves-effect waves-light user_delete">
                                                                <i
                                                                    class="ri-delete-bin-5-line"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                    @endif
                                </table>
                                <div class="mt-4">
                                    {{$admins->links()}}
                                </div>
                            </div>
                            <div class="tab-pane {{ $activeTab === 'border-navs-deleted' ? 'active' : '' }}"
                                 id="border-navs-deleted" role="tabpanel">

                                <table class=" table table-bordered users-table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{__('msg.name')}}</th>
                                        <th class="text-center">{{__('msg.username')}}</th>
                                        <th class="text-center">{{__('msg.email')}}</th>
                                        <th class="text-center">{{__('msg.phone')}}</th>
                                        <th class="text-center">{{__('msg.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($trashed_admins && count($trashed_admins) > 0)
                                        @foreach($trashed_admins as $ditem)
                                            <tr>
                                                <td class="text-center cursor-pointer">
                                                    {{$loop->iteration}}
                                                </td>
                                                <td class="text-center">{{$ditem->name}}</td>
                                                <td class="text-center">{{$ditem->username}}</td>
                                                <td class="text-center">{{$ditem->email}}</td>
                                                <td class="text-center">{{$ditem->phone}}</td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-2 align-items-center justify-content-center">
                                                        <div class="edit">
                                                            <button wire:click="restoreConfirmation({{$ditem->id}})"
                                                                    type="button"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="استعادة"
                                                                    class="btn btn-primary btn-icon waves-effect waves-light">
                                                                <i class="ri-delete-back-fill"></i></button>
                                                        </div>
                                                        <div class="remove">

                                                            <button wire:click="forceDeleteConfirmation({{$ditem->id}})"
                                                                    type="button"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="حذف نهائي"
                                                                    class="btn btn-danger btn-icon waves-effect waves-light">
                                                                <i
                                                                    class="ri-delete-row"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                    @endif
                                </table>
                                <div class="mt-4">
                                    {{$trashed_admins->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
