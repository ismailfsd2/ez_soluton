@extends('theme1.customer.layout')
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
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md">
                                                <div>
                                                    <h4 class="fw-bold">{{ $quotation->name }}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div>Phone : <span class="fw-medium">{{ $quotation->phone; }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>Email : <span class="fw-medium">{{ $quotation->email; }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>City : <span class="fw-medium">{{ $quotation->city; }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>State : <span class="fw-medium">{{ $quotation->state; }}</span></div>
                                                        <div class="vr"></div>
                                                        <div>Country : <span class="fw-medium">{{ $quotation->email; }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button type="button" class="btn py-0 fs-16 favourite-btn active">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-flag-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                            Overview
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-activities" role="tab">
                                            Comments
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
                                <div class="col-xl-9 col-lg-8">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex border-bottom-dashed">
                                            <h4 class="card-title mb-0 flex-grow-1">Summary</h4>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#acceptPriceModal">Accept Price</button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="text-muted">
                                                <div class="pt-3 mt-4">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Reference No:</p>
                                                                <h5 class="fs-15 mb-0">{{ $quotation->reference_no }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Create Date:</p>
                                                                <h5 class="fs-15 mb-0">{{ $quotation->created_at }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                                                <div class="badge bg-warning fs-12">{{ $quotation->status }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pt-3 border-top border-top-dashed mt-4">
                                                    <h6 class="mb-3 fw-semibold text-uppercase">Materials</h6>
                                                    <div class="pt-3 border-top border-top-dashed mt-4">
                                                        <div class="action-btn mb-3">
                                                            <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#addmeterialModule">Add New Meterial</button>
                                                        </div>
                                                        <table id="QuotationsTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Material Name</th>
                                                                    <th>Vendor</th>
                                                                    <th>Material Quantity</th>
                                                                    <th>Vendor Price</th>
                                                                    <th>Estimated Delivery Date</th>
                                                                    <th>Quote Expiry Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($items as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ++$key }}</td>
                                                                        <td>{{ $item->product_name}}</td>
                                                                        <td>{{ $item->vendor_name}}</td>
                                                                        <td>{{ $item->quantity }}</td>
                                                                        <td>{{ $item->vendor_price }}</td>
                                                                        <td>{{ $item->estimated_delivery_date }}</td>
                                                                        <td>{{ $item->quote_expiry_date }}</td>
                                                                        <td>
                                                                            <div class="dropdown d-inline-block">
                                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="ri-more-fill align-middle"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li>
                                                                                        <button type="button" class="dropdown-item remove-item-btn edit_meterial" data-bs-toggle="modal" data-bs-target="#updatemeterialModule" data-id="{{ $item->id }}" data-product_name="{{ $item->product_name }}" data-product_id="{{ $item->product_id }}" data-vendor_id="{{ $item->vendor_id }}" data-quantity="{{ $item->quantity }}" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item remove-item-btn" href="{{ route('customer.quotations.delete_materail',$item->id) }}"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>

                                                                                </li>
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
                                                <div class="pt-3 border-top border-top-dashed mt-4">
                                                    <h6 class="mb-3 fw-semibold text-uppercase">Add-Ons Materials</h6>
                                                    <div class="pt-3 border-top border-top-dashed mt-4">
                                                        <div class="action-btn mb-3">
                                                            <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#addaddonmeterialModule">Add New Add-Ons Meterial</button>
                                                        </div>
                                                        <table id="QuotationsTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Material Name</th>
                                                                    <th>Material Description</th>
                                                                    <th>Material Quantity</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($addons as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ++$key }}</td>
                                                                        <td>{{ $item->product_name}}</td>
                                                                        <td>{{ $item->product_description}}</td>
                                                                        <td>{{ $item->quantity }}</td>
                                                                        <td>
                                                                            <div class="dropdown d-inline-block">
                                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="ri-more-fill align-middle"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                                    <li><button type="button" class="dropdown-item remove-item-btn edit_addonmeterial" data-bs-toggle="modal" data-bs-target="#updateaddonmeterialModule" data-id="{{ $item->id }}" data-product_description="{{ $item->product_description }}" data-product_name="{{ $item->product_name }}" data-quantity="{{ $item->quantity }}" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button></li>
                                                                                    <li><a class="dropdown-item remove-item-btn" href="{{ route('customer.quotations.delete_addonmaterail',$item->id) }}"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                                                </li>
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
                                <div class="col-xl-3 col-lg-4">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex border-bottom-dashed">
                                            <h4 class="card-title mb-0 flex-grow-1">Orders</h4>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inviteMembersModal">Create Order</button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div data-simplebar style="height: 235px;" class="mx-n3 px-3">
                                                <div class="vstack gap-3">
                                                </div>
                                                <!-- end list -->
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->

                                    <div class="card">
                                        <div class="card-header align-items-center d-flex border-bottom-dashed">
                                            <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn btn-soft-info btn-sm"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="vstack gap-2">
                                                <div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                    <i class="ri-folder-zip-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">App-pages.zip</a></h5>
                                                            <div>2.2MB</div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                    <i class="ri-file-ppt-2-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">Velzon-.ppt</a></h5>
                                                            <div>2.4MB</div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                    <i class="ri-folder-zip-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">Images.zip</a></h5>
                                                            <div>1.2MB</div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                    <i class="ri-image-2-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">bg-pattern.png</a></h5>
                                                            <div>1.1MB</div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-2 text-center">
                                                    <button type="button" class="btn btn-success">View more</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="project-activities" role="tabpanel">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Comments</h4>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div data-simplebar style="height: 300px;overflow-x: hidden;overflow-y: scroll;" class="px-3 mx-n3 mb-2" id="conversation_box">
                                    </div>
                                    <form class="mt-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="messageText" class="form-label text-body">Leave a Message</label>
                                                <textarea class="form-control bg-light border-light" id="messageText" rows="3" placeholder="Enter your message..."></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addmeterialModule" tabindex="-1" aria-labelledby="addmeterialModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.quotations.add_materail') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addmeterialModuleLabel">Add New Meterial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
                            <label for="autoCompleteFruit">Select Raw Material</label><br>
                            <input type="text" class="form-control bg-light border-0 searchmaterials"  placeholder="Enter Name or Barcode" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                            <div id="suggesstion-box"></div>
                            <input type="hidden" name="product_id" id="product_id" class="ac_product_id" >
                        </div>
                        <div class="mb-3">
                            <label>Vendor</label><br>
                            <select name="vendor" id="vendors" class="form-control bg-light border-0">
                                <option value="">Select Vendor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label><br>
                            <input type="text" name="quantity" id="quantity" value="1" class="form-control bg-light border-0" >
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
     <div class="modal fade" id="addaddonmeterialModule" tabindex="-1" aria-labelledby="addaddonmeterialModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.quotations.add_addonmaterail') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addaddonmeterialModuleLabel">Add New Meterial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
                        <div class="mb-3">
                            <label>Material Name</label><br>
                            <input type="text" name="name" id="addons_name" class="form-control bg-light border-0" >
                        </div>
                        <div class="mb-3">
                            <label>Material Details</label><br>
                            <textarea name="detail" id="addons_detail" class="form-control bg-light border-0"  rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label><br>
                            <input type="text" name="quantity" id="addons_quantity" value="1" class="form-control bg-light border-0" >
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
     <div class="modal fade" id="updateaddonmeterialModule" tabindex="-1" aria-labelledby="updateaddonmeterialModule" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.quotations.udpate_addonmaterail') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateaddonmeterialModule">Update Add-Ons Meterial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Material Name</label><br>
                            <input type="text" name="name" id="edit_addons_name" class="form-control bg-light border-0" >
                            <input type="hidden" name="id" id="edit_addons_id">
                        </div>
                        <div class="mb-3">
                            <label>Material Details</label><br>
                            <textarea name="detail" id="edit_addons_detail" class="form-control bg-light border-0"  rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label><br>
                            <input type="text" name="quantity" id="edit_addons_quantity" value="1" class="form-control bg-light border-0" >
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
    <div class="modal fade" id="updatemeterialModule" tabindex="-1" aria-labelledby="updatemeterialModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.quotations.udpate_materail') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemeterialModuleLabel">Update Meterial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="autoCompleteFruit">Select Raw Material</label><br>
                            <input type="hidden" name="id" id="edit_item_id" value="0">
                            <input type="text" class="form-control bg-light border-0 searchmaterials" id="editProductName"  placeholder="Enter Name or Barcode" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                            <div id="suggesstion-box"></div>
                            <input type="hidden" name="product_id" id="edi_product_id" class="ac_product_id" >
                        </div>
                        <div class="mb-3">
                            <label>Vendor</label><br>
                            <select name="vendor" id="edit_vendors" class="form-control bg-light border-0">
                                <option value="">Select Vendor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label><br>
                            <input type="text" name="quantity" id="edit_quantity" value="1" class="form-control bg-light border-0" >
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
    <div class="modal fade" id="acceptPriceModal" tabindex="-1" aria-labelledby="updatemeterialModuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.quotations.accept_price') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemeterialModuleLabel">Accept Price & Create Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="autoCompleteFruit">Select Raw Material</label><br>
                            <input type="hidden" name="id" id="edit_item_id" value="0">
                            <input type="text" class="form-control bg-light border-0 searchfinishgoods" id="FinishGoodtName"  placeholder="Enter Name or Barcode" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                            <div id="suggesstion-box"></div>
                            <input type="hidden" name="product_id" id="edi_product_id" class="ac_product_id">
                        </div>
                        <div class="mb-3">
                            <label>Vendor</label><br>
                            <select name="vendor" id="edit_vendors" class="form-control bg-light border-0">
                                <option value="">Select Vendor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label><br>
                            <input type="text" name="quantity" id="edit_quantity" value="1" class="form-control bg-light border-0" >
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
        chat_syn(true);
        // setInterval(function () {
        //     chat_syn();
        // }, 2000);
        function chat_syn(down = false){
            var id = {{ $quotation->id }};
            $.ajax({
                url: "{{ route('conversations.syn') }}",
                type: 'GET',
                data: {id:id},
                success: function(data) {
                    $('#conversation_box').html(data);
                    if(down){
                        $('#conversation_box').animate({ scrollTop: $("#conversation_box").height() }, 50);
                    }
                    setTimeout(chat_syn, 2000);
                }
            });
        }
        $('#sendMessageBtn').click(function(){
            var type = 1;
            var intenal_message = 0;
            var message = $('#messageText').val();
            var id = {{ $quotation->id }};
            if ($('#intenal_message').is(':checked')) {
                intenal_message = 1;
            }
            $.ajax({
                url: "{{ route('conversations.send_message') }}",
                type: 'POST',
                data: {id:id,type:type,intenal_message:intenal_message,message:message},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#messageText').val("");
                    chat_syn(true);
                }
            });
        });
        $(".searchmaterials").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'get',
                    url: '{{ route("customer.general.searching.materials") }}',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                $('.ac_product_id').val(ui.item.item_id);
                var vendor_opts = '<option value="">Select Vendor</option>';
                $.each(ui.item.vendors, function(index) {
                    var vendor = this;
                    vendor_opts += '<option value="'+vendor.id+'" >'+vendor.name+'</option>';
                });
                $('#vendors').html(vendor_opts);
            }
        });
        $(".searchfinishgoods").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'get',
                    url: '{{ route("customer.general.searching.finish_goods") }}',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                $('.ac_product_id').val(ui.item.item_id);
            }
        });
        $(document).on('click','.edit_meterial',function(){
            var id = $(this).data('id');
            var product_id = $(this).data('product_id');
            var product_name = $(this).data('product_name');
            var vendor_id = $(this).data('vendor_id');
            var quantity = $(this).data('quantity');
            $.ajax({
                url: "{{ route('customer.general.list.product_vendors') }}",
                type: 'get',
                data: {product_id:product_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    var vendor_opts = '<option value="">Select Vendor</option>';
                    $.each(obj.vendors, function(index) {
                        var vendor = this;
                        vendor_opts += '<option value="'+vendor.id+'" >'+vendor.name+'</option>';
                    });
                    $('#edit_vendors').html(vendor_opts);
                    $('#edit_item_id').val(id);
                    $('#edi_product_id').val(product_id);
                    $('#editProductName').val(product_name);
                    $('#edit_vendors').val(vendor_id);
                    $('#edit_quantity').val(quantity);
                }
            });

        });
        $(document).on('click','.edit_addonmeterial',function(){
            var id = $(this).data('id');
            var product_description = $(this).data('product_description');
            var product_name = $(this).data('product_name');
            var quantity = $(this).data('quantity');
            $('#edit_addons_id').val(id);
            $('#edit_addons_name').val(product_name);
            $('#edit_addons_detail').text(product_description);
            $('#edit_addons_quantity').val(quantity);

        });
    });
</script>

@stop
