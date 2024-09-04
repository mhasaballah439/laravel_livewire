
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="#" class="d-inline-block auth-logo">
                            <img src="{{asset('assets/images/logo.png')}}" alt="" height="20">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">{{__('msg.Welcome_Back')}}</h5>
                            <p class="text-muted">{{__('msg.Sign_in_to_continue_to')}} {{__('msg.app_name')}}</p>
                        </div>

                        <div class="p-2 mt-4">
                            <div x-data="{ errorMessage: '' }"
                                 x-init="$wire.on('loginError', message => { errorMessage = message; setTimeout(() => errorMessage = '', 5000) })">

                            <form wire:submit.prevent="login">

                                <div class="mb-3">
                                    <label for="username" class="form-label">{{__('msg.Username')}}</label>
                                    <input type="text" class="form-control" id="username" wire:model="username" placeholder="{{__('msg.Enter_username')}}">
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="float-end">
                                        <a wire:navigate href="{{route('dashboard.auth.reset_password')}}" class="text-muted">{{__('msg.Forgot_password')}}</a>
                                    </div>
                                    <label class="form-label" for="password-input">{{__('msg.Password')}}</label>
                                    <div x-data="{ showPassword: false }" class="position-relative auth-pass-inputgroup mb-3">
                                        <input
                                            :type="showPassword ? 'text' : 'password'"
                                            class="form-control pe-5"
                                            wire:model="password"
                                            placeholder="Enter password"
                                            id="password-input"
                                        >
                                        <button
                                            @click="showPassword = !showPassword"
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                            type="button"
                                            id="password-addon"
                                        >
                                            <i :class="showPassword ? 'ri-eye-off-fill' : 'ri-eye-fill'" class="align-middle"></i>
                                        </button>
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"  wire:model="remember_me" type="checkbox" value="" id="auth-remember-check">
                                    <label class="form-check-label" for="auth-remember-check">{{__('msg.Remember_me')}}</label>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">{{__('msg.Sign_In')}}</button>
                                </div>
                                <template x-if="errorMessage">
                                    <div class="alert alert-danger mt-3" x-text="errorMessage"></div>
                                </template>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
