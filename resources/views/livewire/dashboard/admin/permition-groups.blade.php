<div class="page-content">
    <div class="container-fluid">

        <div class="row">
<div class="col-lg-12">
    <div class="card">

        <div class="card-header" style="display: flex;align-items: center;justify-content: space-between;">
            <h5 class="card-title mb-0">{{__('msg.permitions_groups')}}</h5>
            <button wire:click="createItem" class="btn rounded-pill btn-primary waves-effect waves-light"
            >{{__('msg.create')}}
            </button>
        </div>

        <div class="modal fade" wire:ignore.self id="deleteConfrmationModal" aria-hidden="true" aria-labelledby="..."
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
        <div class="modal fade" wire:ignore.self id="restoreConfrmationModal" aria-hidden="true" aria-labelledby="..."
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


        <div class="modal fade" wire:ignore.self id="addItemModal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="card-body">
                            <form wire:submit.prevent="storeItem">
                                <div class="live-preview">
                                    <div class="row gy-4">
                                        <!--end col-->
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">{{__('msg.name')}}</label>
                                                <div class="form-icon">
                                                    <input type="text" wire:model="name"
                                                           @error('name') is-invalid @enderror
                                                           class="form-control form-control-icon"
                                                           id="name" placeholder="{{__('msg.enter_name')}}" autocomplete="off">
                                                    <i class=" ri-file-text-line"></i>
                                                </div>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="iconInput"
                                                       class="form-label">{{__('msg.is_default')}}</label>
                                                <select class="form-control" wire:model="is_default"
                                                        @error('is_default') is-invalid @enderror
                                                        id="is_default">
                                                    <option value="0">{{__('msg.no')}}</option>
                                                    <option value="1">{{__('msg.yes')}}</option>
                                                </select>
                                                @error('is_default')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <p class="mt-4"><strong>{{__('msg.permissions')}}</strong></p>

                                    <hr>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">{{__('msg.name')}}</th>
                                                <th scope="col">{{__('msg.active')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($urls) && count($urls) > 0)
                                                @foreach ($urls as $url)
                                                    @if(isset($url->sub_links) && count($url->sub_links) > 0)
                                                        @foreach ($url->sub_links as $sub_link)
                                                            <tr class="text-center">
                                                                <td>{{$sub_link->name}}</td>
                                                                <td>
                                                                    <div class="form-check form-switch text-center">
                                                                        <input class="form-check-input"
                                                                               wire:model="links"
                                                                               value="{{$sub_link->id}}"
                                                                               type="checkbox" role="switch"
                                                                               id="link_{{$sub_link->id}}">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @elseif($url->parent_id == 0 && !isset($url->sub_links))
                                                        <tr class="text-center">
                                                            <td>{{$url->name}}</td>
                                                            <td>
                                                                <div class="form-check form-switch text-center">
                                                                    <input class="form-check-input"
                                                                           wire:model="links"
                                                                           value="{{$url->id}}"
                                                                           type="checkbox" role="switch"
                                                                           id="link_{{$url->id}}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="buttons" style="margin-top: 15px;">
                                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">{{__('msg.save')}}</button>
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

        <div class="modal fade" wire:ignore.self id="editItemModal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="card-body">
                            <form wire:submit.prevent="updateItem">
                                <div class="live-preview">
                                    <div class="row gy-4">
                                        <!--end col-->
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">{{__('msg.name')}}</label>
                                                <div class="form-icon">
                                                    <input type="text" wire:model="name"
                                                           @error('name') is-invalid @enderror
                                                           class="form-control form-control-icon"
                                                           id="name" placeholder="{{__('msg.enter_name')}}" autocomplete="off">
                                                    <i class=" ri-file-text-line"></i>
                                                </div>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-md-6">
                                            <div>
                                                <label for="iconInput"
                                                       class="form-label">{{__('msg.is_default')}}</label>
                                                <select class="form-control" wire:model="is_default"
                                                        @error('is_default') is-invalid @enderror
                                                        id="is_default">
                                                    <option value="0">{{__('msg.no')}}</option>
                                                    <option value="1">{{__('msg.yes')}}</option>
                                                </select>
                                                @error('is_default')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <p class="mt-4"><strong>{{__('msg.permissions')}}</strong></p>

                                    <hr>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">{{__('msg.name')}}</th>
                                                <th scope="col">{{__('msg.active')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($urls) && count($urls) > 0)
                                                @foreach ($urls as $url)
                                                    @if(isset($url->sub_links) && count($url->sub_links) > 0)
                                                        @foreach ($url->sub_links as $sub_link)
                                                            <tr class="text-center">
                                                                <td>{{$sub_link->name}}</td>
                                                                <td>
                                                                    <div class="form-check form-switch text-center">
                                                                        <input class="form-check-input"
                                                                               wire:model="links"
                                                                               value="{{$sub_link->id}}"
                                                                               type="checkbox" role="switch"
                                                                               id="link_{{$sub_link->id}}">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @elseif($url->parent_id == 0 && !isset($url->sub_links))
                                                        <tr class="text-center">
                                                            <td>{{$url->name}}</td>
                                                            <td>
                                                                <div class="form-check form-switch text-center">
                                                                    <input class="form-check-input"
                                                                           wire:model="links"
                                                                           value="{{$url->id}}"
                                                                           type="checkbox" role="switch"
                                                                           id="link_{{$url->id}}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="buttons" style="margin-top: 15px;">
                                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">{{__('msg.save')}}</button>
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
                       role="tab">{{__('msg.permitions_groups')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab === 'border-navs-deleted' ? 'active' : '' }}"
                       wire:click="switchTab('border-navs-deleted')"
                       data-bs-toggle="tab" href="#border-navs-deleted"
                       role="tab">{{__('msg.deleted_permitions_groups')}}</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane {{ $activeTab === 'border-navs-all' ? 'active' : '' }}" id="border-navs-all"
                     role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="iconInput" class="form-label">{{__('msg.search')}}</label>
                            <input wire:model="search" type="text" class="form-control"
                                   placeholder="{{__('msg.search')}}">
                        </div>
                    </div>
                    <table class=" table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{__('msg.name')}}</th>
                            <th class="text-center">{{__('msg.is_default')}}</th>
                            <th class="text-center">{{__('msg.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($groups && count($groups) > 0)
                            @foreach($groups as $item)
                                <tr>
                                    <td class="text-center cursor-pointer">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="text-center">{{$item->name}}</td>
                                    <td class="text-center">
                                        @if($item->is_default == 1 )
                                            <i class="ri-checkbox-circle-line text-success"></i>
                                        @else
                                            <i class=" ri-close-circle-line text-danger"></i>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex  gap-2 align-items-center justify-content-center">
                                            <div class="edit">
                                                <a wire:click="editItem({{$item->id}})" type="button"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل"
                                                   class="btn btn-primary btn-icon waves-effect waves-light">
                                                    <i class=" ri-edit-line"></i></a>
                                            </div>
                                            <div class="remove">

                                                <button wire:click="deleteConfirmation({{$item->id}})" type="button"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="حذف"
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
                        {{$groups->links()}}
                    </div>
                </div>
                <div class="tab-pane {{ $activeTab === 'border-navs-deleted' ? 'active' : '' }}"
                     id="border-navs-deleted" role="tabpanel">

                    <table class=" table table-bordered users-table" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{__('msg.name')}}</th>
                            <th class="text-center">{{__('msg.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($deleted_groups && count($deleted_groups) > 0)
                            @foreach($deleted_groups as $ditem)
                                <tr>
                                    <td class="text-center cursor-pointer">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="text-center">{{$ditem->name}}</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                            <div class="edit">
                                                <button wire:click="restoreConfirmation({{$ditem->id}})"
                                                        type="button"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="استعادة"
                                                        class="btn btn-primary btn-icon waves-effect waves-light">
                                                    <i class="ri-delete-back-fill"></i></button>
                                            </div>
                                            <div class="remove">

                                                <button wire:click="forceDeleteConfirmation({{$ditem->id}})"
                                                        type="button"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="حذف نهائي"
                                                        class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                        class="ri-delete-row"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                        @endif
                    </table>
                    <div class="mt-4">
                        {{$deleted_groups->links()}}
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
    $wire.on('close', () => {
        $('#addItemModal').modal('hide');
        $('#editItemModal').modal('hide');
        $('#deleteConfrmationModal').modal('hide');
        $('#restoreConfrmationModal').modal('hide');
        $('#forceDeleteConfrmationModal').modal('hide');

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.success('تمت العملية بنجاح');
    });
    $wire.on('create-item', () => {
        $('#addItemModal').modal('show');
    });
    $wire.on('edit-item', () => {
        $('#editItemModal').modal('show');
    });
    $wire.on('delete-confirmation-item', () => {
        $('#deleteConfrmationModal').modal('show');
    });
    $wire.on('restore-confirmation-item', () => {
        $('#restoreConfrmationModal').modal('show');
    });
    $wire.on('force-delete-confirmation-item', () => {
        $('#forceDeleteConfrmationModal').modal('show');
    });
    $wire.on('catch-error', (message) => {
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.error(message);
    });
</script>
@endscript
@push('styles')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
@endpush
