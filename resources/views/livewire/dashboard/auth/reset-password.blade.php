<!-- auth page content -->
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
                        <div
                            x-data="{ errorMessage: '', successMessage: '', codeErrorMessage: '', codeSuccessMessage: '', is_sent: @entangle('is_sent') }"
                            x-init="
            $wire.on('resetError', message => { errorMessage = message; setTimeout(() => errorMessage = '', 5000) });
            $wire.on('resetSuccess', message => { successMessage = message; setTimeout(() => successMessage = '', 6000) });
            $wire.on('codeError', message => { codeErrorMessage = message; setTimeout(() => codeErrorMessage = '', 5000) });
            $wire.on('codeSuccess', message => { codeSuccessMessage = message; setTimeout(() => codeSuccessMessage = '', 5000) });
        "
                        >
                            <!-- Form 1 -->
                            <template x-if="is_sent === 0">
                                <div>
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">{{__('msg.Forgot_Password')}}</h5>
                                        <p class="text-muted">{{__('msg.Reset_password_with')}} {{__('msg.app_name')}}</p>

                                        <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                                   colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
                                    </div>
                                    <div>
                                        <div class="alert alert-borderless alert-warning text-center mb-2 mx-2"
                                             role="alert">
                                            {{__('msg.Enter_your_email_and_instructions_will_be_sent_to_you')}}!
                                        </div>
                                        <div class="p-2">
                                            <form wire:submit.prevent="resetPassword">
                                                <div class="mb-4">
                                                    <label class="form-label">{{__('msg.Email')}}</label>
                                                    <input type="email" class="form-control" wire:model="email" id="email"
                                                           placeholder="{{__('msg.Enter_Email')}}">
                                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button class="btn btn-success w-100" type="submit">
                                                        {{__('msg.Send_Reset_Link')}}
                                                    </button>
                                                </div>

                                                <template x-if="errorMessage">
                                                    <div class="alert alert-danger mt-3" x-text="errorMessage"></div>
                                                </template>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Form 2 -->
                            <template x-if="is_sent === 1">
                                <div>
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <div class="text-muted text-center mb-4 mx-lg-3">
                                            <h4>{{__('msg.Verify_Your_Email')}}</h4>
                                            <p>{{__('msg.Enter_the_4_digit_code_sent_to')}} <span class="fw-semibold">{{ $email ?? '' }}</span></p>
                                        </div>
                                        <template x-if="successMessage">
                                            <div class="alert alert-success mt-3" x-text="successMessage"></div>
                                        </template>
                                        <form wire:submit.prevent="checkVerificationCode">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                        <input type="text" wire:model="code1"
                                                               class="form-control form-control-lg bg-light border-light text-center"
                                                               onkeyup="moveToNext(this, 2)" maxLength="1" id="digit1-input">
                                                        @error('code1') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                        <input type="text" wire:model="code2"
                                                               class="form-control form-control-lg bg-light border-light text-center"
                                                               onkeyup="moveToNext(this, 3)" maxLength="1" id="digit2-input">
                                                        @error('code2') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                        <input type="text" wire:model="code3"
                                                               class="form-control form-control-lg bg-light border-light text-center"
                                                               onkeyup="moveToNext(this, 4)" maxLength="1" id="digit3-input">
                                                        @error('code3') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                        <input type="text" wire:model="code4"
                                                               class="form-control form-control-lg bg-light border-light text-center"
                                                               onkeyup="moveToNext(this, 4)" maxLength="1" id="digit4-input">
                                                        @error('code4') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-success w-100">{{__('msg.Confirm')}}</button>
                                            </div>

                                            <template x-if="codeErrorMessage">
                                                <div class="alert alert-danger mt-3" x-text="codeErrorMessage"></div>
                                            </template>
                                        </form>
                                    </div>
                                </div>
                            </template>

                            <!-- Form 3 -->
                            <template x-if="is_sent === 2">
                                <div>
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">{{__('msg.Lock_password')}}</h5>
                                        <p class="text-muted">{{__('msg.Enter_your_password_to_unlock_the_screen')}}!</p>
                                    </div>
                                    <template x-if="codeSuccessMessage">
                                        <div class="alert alert-success mt-3" x-text="codeSuccessMessage"></div>
                                    </template>
                                    <div class="p-2 mt-4">
                                        <form wire:submit.prevent="updatePassword">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">{{__('msg.Password')}}</label>
                                                <input type="password" wire:model="password" class="form-control" id="userpassword"
                                                       placeholder="{{__('msg.Enter_Password')}}" required>
                                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <template x-if="errorMessage">
                                                <div class="alert alert-danger mt-3" x-text="errorMessage"></div>
                                            </template>
                                            <div class="mb-2 mt-4">
                                                <button class="btn btn-success w-100" type="submit">{{__('msg.Unlock')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">{{__('msg.Wait_I_remember_my_password')}}... <a href="{{route('dashboard.auth.login')}}"
                                                                                wire:navigate
                                                                                class="fw-semibold text-primary text-decoration-underline"> {{__('msg.Click_here')}} </a>
                </p>
            </div>

        </div>
    </div>
    <!-- end row -->
</div>
