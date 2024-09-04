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


        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">
                    <div class="card-body p-4 text-center">
                        <div class="avatar-lg mx-auto mt-2">
                            <div class="avatar-title bg-light text-success display-3 rounded-circle">
                                <i class="ri-checkbox-circle-fill"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <h4>{{__('msg.success_login_title')}}</h4>
                            <p class="text-muted mx-4">{{__('msg.success_login_desc')}}</p>
                            <div class="mt-4">
                                <a href="{{route('dashboard')}}" wire:navigate class="btn btn-success w-100">{{__('msg.Back_to_Dashboard')}}</a>
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
