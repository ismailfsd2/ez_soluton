@extends('theme1.admin.layout')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

@stop
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4">
                        <div class="bg-soft-warning">
                            <div class="card-body pb-0 px-4">
                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                            Overview
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex border-bottom-dashed">
                                            <h4 class="card-title mb-0 flex-grow-1">Summary</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="text-muted">
                                                <div class="pt-3 mt-4">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Reference No:</p>
                                                                <h5 class="fs-15 mb-0">#{{ Helper::decimal_val($order->id) }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Vendor:</p>
                                                                <h5 class="fs-15 mb-0">{{ $ov->name }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Customer:</p>
                                                                <h5 class="fs-15 mb-0">{{ $oc->name }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Create Date:</p>
                                                                <h5 class="fs-15 mb-0">{{ $order->created_at }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                                                <div class="badge  @if($order->status == 'open') bg-warning @else bg-success @endif  fs-12">{{ $order->status }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pt-3 border-top border-top-dashed mt-4">
                                                    <h6 class="mb-3 fw-semibold text-uppercase">Items</h6>
                                                    <div class="pt-3 border-top border-top-dashed mt-4">
                                                        <table id="OrdersTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Material Name</th>
                                                                    <th>Material Quantity</th>
                                                                    <th>Vendor Price</th>
                                                                    <th>Total</th>
                                                                    <th>ETA Date</th>
                                                                    <th>ETS Date</th>
                                                                    <th>Delivery Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($items as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ++$key }}</td>
                                                                        <td>{{ $item->product_name}}</td>
                                                                        <td>{{ $item->quantity }}</td>
                                                                        <td>{{ $item->price }}</td>
                                                                        <td>{{ $item->total }}</td>
                                                                        <td>{{ $item->eta_date }}</td>
                                                                        <td>{{ $item->ets_date }}</td>
                                                                        <td>{{ $item->delivery_date }}</td>
                                                                        <td>
                                                                            <div class="dropdown d-inline-block">
                                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="ri-more-fill align-middle"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    @if($item->eta_date == "")
                                                                                        <li><a class="dropdown-item submit-edate-btn" href="#" data-id="{{ $item->id }}" data-eta_date="{{ $item->eta_date }}" data-ets_date="{{ $item->ets_date }}" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="ri-money-dollar-circle-line align-bottom me-2 text-muted"></i> Submit Estimated Dates</a></li>
                                                                                    @else
                                                                                        <li><a class="dropdown-item submit-deliverydate-btn" href="#" data-id="{{ $item->id }}" data-delivery_date="{{ $item->delivery_date }}" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2"><i class="ri-money-dollar-circle-line align-bottom me-2 text-muted"></i> Submit Delivery Date</a></li>
                                                                                    @endif
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end row -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->

                                </div>
                                <!-- ene col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <div class="modal fade bs-example-modal-center" id="princeModule" tabindex="-1" aria-labelledby="princeModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.submit_estimated_date') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="princeModuleLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="id" value="0" id="edate_item_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">ETA Date</label>
                            <input type="text" name="eta_date" id="eta_date" required="required" class="form-control bg-light border-0" data-provider="flatpickr" data-time="true" placeholder="Select Date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">ETS Date</label>
                            <input type="text" name="ets_date" id="ets_date" required="required" class="form-control bg-light border-0" data-provider="flatpickr" data-time="true" placeholder="Select Date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-center2" id="deliveryDateModule" tabindex="-1" aria-labelledby="deliveryDateModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.submit_deliverydate_date') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="deliveryDateModuleLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="id" value="0" id="ddate_item_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Delivery Date</label>
                            <input type="text" name="delivery_date" id="delivery_date" required="required" class="form-control bg-light border-0" data-provider="flatpickr" data-time="true" placeholder="Select Date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop
@section('footer')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.submit-edate-btn').click(function(){
            var id = $(this).data('id');
            $('#edate_item_id').val(id);
            $('#eta_date').val($(this).data('eta_date'));
            $('#ets_date').val($(this).data('ets_date'));
        });
        $('.submit-deliverydate-btn').click(function(){
            var id = $(this).data('id');
            $('#ddate_item_id').val(id);
            $('#delivery_date').val($(this).data('delivery_date'));
        });
    });

</script>
@stop
