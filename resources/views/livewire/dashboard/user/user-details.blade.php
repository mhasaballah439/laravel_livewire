<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{$user->store_name}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                           wire:navigate>{{__('msg.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.users')}}"
                                                           wire:navigate>{{__('msg.owners')}}</a></li>
                            <li class="breadcrumb-item active">{{$user->store_name}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-4">
                        <div>
                            <div class="flex-shrink-0 avatar-md mx-auto">
                                <div class="avatar-title bg-light rounded">
                                    <img src="{{isset($user->image) ? asset($user->image->file_path) : ''}}" alt="image"
                                         height="50"/>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-1">{{$user->store_name}}</h5>
                                <p class="text-muted">{{$user->username}}</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <tbody>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.name')}}</span></th>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.email')}}</span></th>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.phone')}}</span></th>
                                        <td>{{$user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.website')}}</span></th>
                                        <td><a href="{{$user->domain}}" target="_blank"
                                               class="link-primary">{{$user->domain}}</a></td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.language')}}</span></th>
                                        <td>{{$user->language->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.currency')}}</span></th>
                                        <td>{{$user->currency->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.special')}}</span></th>
                                        <td>{{$user->special->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">{{__('msg.active')}}</span></th>
                                        <td>{{$user->active == 1 ? __('msg.active') : __('msg.inactive')}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                    <div class="card-body border-top border-top-dashed p-4">
                        <div>
                            <h6 class="text-muted text-uppercase fw-semibold mb-4">Customer Reviews</h6>
                            <div>
                                <div>
                                    <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="fs-16 align-middle text-warning">
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-half-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h6 class="mb-0">4.5 out of 5</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-muted">Total <span class="fw-medium">5.50k</span>
                                            reviews
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">5 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 50.16%" aria-valuenow="50.16" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">2758</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">4 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 29.32%" aria-valuenow="29.32" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">1063</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">3 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         style="width: 18.12%" aria-valuenow="18.12" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">997</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">2 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 4.98%" aria-valuenow="4.98" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">227</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">1 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: 7.42%" aria-valuenow="7.42" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">408</h6>
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div>

                    <div class="card-header p-0 border-0 bg-soft-light">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span>
                                    </h5>
                                    <p class="text-muted mb-0">Orders</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                                    <p class="text-muted mb-0">Earnings</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="367">0</span>
                                    </h5>
                                    <p class="text-muted mb-0">Refunds</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value"
                                                                        data-target="18.92">0</span>%</h5>
                                    <p class="text-muted mb-0">Conversation Ratio</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="customer_impression_charts"
                                 data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                 class="apex-charts"></div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
                <!--end row-->
            </div>
            <!-- container-fluid -->
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">{{__('msg.products')}}</h5>
                    <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link show active" data-bs-toggle="tab" href="#arrow-products" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-cart-plus"></i></span>
                                <span class="d-none d-sm-block">{{__('msg.products')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#arrow-categories" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-tree"></i></span>
                                <span class="d-none d-sm-block"> {{__('msg.categories')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#arrow-sizes" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-format-size"></i></span>
                                <span class="d-none d-sm-block"> {{__('msg.sizes')}}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#arrow-additions" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-plus-box"></i></span>
                                <span class="d-none d-sm-block">{{__('msg.additions')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#arrow-brands" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-hail"></i></span>
                                <span class="d-none d-sm-block"> {{__('msg.brands')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#arrow-taxes" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-percent"></i></span>
                                <span class="d-none d-sm-block"> {{__('msg.taxes')}}</span>
                            </a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane " id="arrow-products" role="tabpanel">
                            <h6>Give your text a good structure</h6>

                        </div>
                        <div class="tab-pane " id="arrow-categories" role="tabpanel">
                            <section>
                                <livewire:dashboard.user.product.categories :username="$user->username">
                            </section>

                        </div>
                        <div class="tab-pane " id="arrow-sizes" role="tabpanel">
                            <section>
                                <livewire:dashboard.user.product.sizes :username="$user->username">
                            </section>
                        </div>

                        <div class="tab-pane " id="arrow-additions" role="tabpanel">
                            <section>
                                <livewire:dashboard.user.product.additions :username="$user->username">
                            </section>
                        </div>
                        <div class="tab-pane " id="arrow-brands" role="tabpanel">
                            <section>
                                <livewire:dashboard.user.product.brands :username="$user->username">
                            </section>
                        </div>
                        <div class="tab-pane" id="arrow-taxes" role="tabpanel">
                            <section>
                                <livewire:dashboard.user.product.taxes :username="$user->username">
                            </section>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->

        </div>
        <!--end col-->
    </div>
</div>

@script
<script>
    $wire.on('close', (data) => {
        console.log(data)
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
