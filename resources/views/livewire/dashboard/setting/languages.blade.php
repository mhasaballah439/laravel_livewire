<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{__('msg.languages')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                           wire:navigate>{{__('msg.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('msg.languages')}}</li>
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
                    <div class="modal fade" wire:ignore.self id="importModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">{{__('msg.import_languages')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="import">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-12">
                                                        <div>
                                                            <label for="excel_file"
                                                                   class="form-label">{{__('msg.excel_file')}}</label>
                                                            <div class="form-icon">
                                                                <input type="file" wire:model="excel_file"
                                                                       @error('excel_file') is-invalid @enderror
                                                                       class="form-control"
                                                                       id="excel_file">
                                                                <div wire:loading wire:target="excel_file">
                                                            <span class="spinner-border spinner-border-sm" role="status"
                                                                  aria-hidden="true"></span>
                                                                    {{__('msg.file_pressing')}}...
                                                                </div>
                                                            </div>
                                                            @error('excel_file')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <a href="{{asset('assets/files/languages_example.xlsx')}}">{{__('msg.sample_file')}}</a>
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
                    <div class="modal fade" wire:ignore.self id="addItemModal" aria-hidden="true" aria-labelledby="..."
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">{{__('msg.add_new_language')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="storeItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
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
                                                            <label for="code"
                                                                   class="form-label">{{__('msg.code')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="code"
                                                                       @error('code') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="code"
                                                                       placeholder="{{__('msg.enter_code')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('code')
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
                                                    <div class="col-xxl-3 col-md-6">
                                                        <label for="active">{{__('msg.is_default')}}</label>
                                                        <div class="form-check form-switch text-center">
                                                            <input class="form-check-input" wire:model="is_default"
                                                                   type="checkbox" role="switch"
                                                                   id="is_default">
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
                                    <h5 class="modal-title" id="myModalLabel">{{__('msg.edit_language')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="card-body">
                                        <form wire:submit.prevent="updateItem">
                                            <div class="live-preview">
                                                <div class="row gy-4">
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
                                                            <label for="code"
                                                                   class="form-label">{{__('msg.code')}}</label>
                                                            <div class="form-icon">
                                                                <input type="text" wire:model="code"
                                                                       @error('code') is-invalid @enderror
                                                                       class="form-control form-control-icon"
                                                                       id="code"
                                                                       placeholder="{{__('msg.enter_code')}}"
                                                                       autocomplete="off">
                                                                <i class=" ri-file-text-line"></i>
                                                            </div>
                                                            @error('code')
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

                                                    <div class="col-xxl-3 col-md-6">
                                                        <label for="active">{{__('msg.is_default')}}</label>
                                                        <div class="form-check form-switch text-center">
                                                            <input class="form-check-input" wire:model="is_default"
                                                                   type="checkbox" role="switch"
                                                                   id="is_default">
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
                                        <h5 class="card-title mb-0">{{__('msg.languages')}}</h5>
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
                                            <i class="ri-add-line align-bottom me-1"></i>{{__('msg.add_language')}}
                                        </button>
                                        <button type="button" wire:click="importConfirmation"
                                                class="btn btn-info cursor-pointer"><i
                                                class="ri-file-download-line align-bottom me-1"></i>
                                            {{__('msg.import')}}</button>

                                        <button type="button" wire:loading.remove wire:click="export"
                                                class="btn btn-warning cursor-pointer"><i
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
                                                <th class="text-center">{{__('msg.id')}}</th>
                                                <th class="text-center">{{__('msg.name')}}</th>
                                                <th class="text-center">{{__('msg.code')}}</th>
                                                <th class="text-center">{{__('msg.active')}}</th>
                                                <th class="text-center">{{__('msg.is_default')}}</th>
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
                                                    <td class="text-center">{{ $item->id }}</td>
                                                    <td class="text-center">{{ $item->name ?? '-' }}</td>
                                                    <td class="text-center">{{ $item->code ?? '-' }}</td>
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
                                                        @if($item->is_default == 1)
                                                            <i class="ri-checkbox-circle-line text-success"></i>
                                                        @else
                                                            <i class="ri-close-circle-line text-danger"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a wire:click="editItem({{ $item->id }})" class="text-primary mr-2 cursor-pointer">
                                                            <i class="ri-pencil-fill fs-20"></i>
                                                        </a>
                                                        <a wire:click="deleteConfirmation({{ $item->id }})" class="text-danger ml-2 cursor-pointer">
                                                            <i class="ri-delete-bin-5-fill fs-20"></i>
                                                        </a>
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
