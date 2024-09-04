<div class="page-content">
    <div class="container-fluid">

        <div class="position-relative mx-n4" style="margin-top: -5.2rem !important;">
            <div class="profile-wid-bg profile-setting-img">
                <img src="{{asset('assets/images/profile-bg.jpg')}}" class="profile-wid-img" alt="">
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <form wire:submit.prevent="updateImage">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img
                                        src="{{isset(admin()->image) ? asset(admin()->image->file_path) : asset('assets/images/users/avatar-7.jpg')}}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input"
                                               type="file" wire:model="image"
                                               @change="$refs.submitImage.click()"
                                               class="profile-img-file-input">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-light text-body">
                                                            <i class="ri-camera-fill"></i>
                                                        </span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" id="submitImage" x-ref="submitImage" class="d-none"></button>
                            </form>
                            <h5 class="fs-17 mb-1">{{admin()->name}} / {{admin()->username}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'Personal_Details' ? 'active' : '' }}"
                                   wire:click="switchTab('Personal_Details')"
                                   data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    {{__('msg.Personal_Details')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab === 'Change_Password' ? 'active' : '' }}"
                                   wire:click="switchTab('Change_Password')"
                                   data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i>
                                    {{__('msg.Change_Password')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane {{ $activeTab === 'Personal_Details' ? 'active' : '' }}"
                                 id="personalDetails" role="tabpanel">
                                <form wire:submit.prevent="updateProfile">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">{{__('msg.name')}}</label>
                                                <input type="text" class="form-control"
                                                       @error('name') is-invalid @enderror
                                                       id="name"
                                                       placeholder="{{__('msg.enter_name')}}" wire:model="name">
                                            </div>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">{{__('msg.username')}}</label>
                                                <input type="text" class="form-control" id="username"
                                                       wire:model="username"
                                                       @error('username') is-invalid @enderror
                                                       placeholder="{{__('msg.enter_username')}}">
                                            </div>
                                            @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{__('msg.phone')}}</label>
                                                <input type="text" class="form-control"
                                                       wire:model="phone"
                                                       @error('phone') is-invalid @enderror
                                                       id="phone"
                                                       placeholder="{{__('msg.enter_phone')}}"
                                                >
                                            </div>
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{__('msg.email')}}</label>
                                                <input type="email" class="form-control" wire:model="email"
                                                       @error('email') is-invalid @enderror
                                                       id="email"
                                                       placeholder="{{__('msg.enter_email')}}"
                                                >
                                            </div>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit"
                                                        class="btn btn-primary">{{__('msg.update')}}</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>

                            <div class="tab-pane {{ $activeTab === 'Change_Password' ? 'active' : '' }}"
                                 id="changePassword" role="tabpanel">
                                <form wire:submit.prevent="changePassword">

                                    <div class="row g-2">

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="old_password"
                                                       class="form-label">{{__('msg.Old_Password')}} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control"
                                                       wire:model="old_password"
                                                       @error('old_password') is-invalid @enderror
                                                       id="old_password"
                                                       placeholder="{{__('msg.Enter_current_password')}}">
                                            </div>
                                            @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="new_password"
                                                       class="form-label">{{__('msg.New_Password')}} <span
                                                        class="text-danger">*</span> </label>
                                                <input type="password" class="form-control"
                                                       wire:model="new_password"
                                                       @error('new_password') is-invalid @enderror
                                                       id="new_password"
                                                       placeholder="{{__('msg.Enter_new_password')}}">
                                            </div>
                                            @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirm_password"
                                                       class="form-label">{{__('msg.Confirm_Password')}} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control"
                                                       wire:model="confirm_password"
                                                       @error('confirm_password') is-invalid @enderror
                                                       id="confirm_password"
                                                       placeholder="{{__('msg.Confirm_password')}}">
                                            </div>
                                            @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit"
                                                        class="btn btn-success">{{__('msg.Change_Password')}}</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div>
@script
<script>
    $wire.on('close', () => {
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
    $wire.on('passError', (message) => {
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
        toastr.error({{__('msg.error_entered_data')}});
    });
</script>

@endscript

@push('styles')
    <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/profile-setting.init.js')}}"></script>
@endpush
