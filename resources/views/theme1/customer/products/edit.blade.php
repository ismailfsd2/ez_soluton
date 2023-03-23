@extends('theme1.customer.layout')
@section('header')
@stop
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Product</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('customer.products.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required value="{{ $product->name }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="barcode" class="form-label">Barcode</label>
                                            <input type="text" class="form-control" id="barcode" name="barcode" required value="{{ $product->barcode }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="company_code" class="form-label">SKU Code</label>
                                            <input type="text" class="form-control" id="company_code" name="company_code" required value="{{ $product->company_code }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="cost" class="form-label">Cost</label>
                                            <input type="number" class="form-control" id="cost" name="cost" required value="{{ $product->cost }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" required value="{{ $product->price }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="mrp" class="form-label">MRP</label>
                                            <input type="number" class="form-control" id="mrp" name="mrp" required value="{{ $product->mrp }}" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" id="category" class="form-control" required >
                                                <option value="">Select Category</option>
                                                @foreach($categories as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $product->category_id){ echo 'selected'; } ?> >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="brand" class="form-label">Brand</label>
                                            <select name="brand" id="parent" class="form-control" required >
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $product->brand_id){ echo 'selected'; } ?> >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="unit" class="form-label">Unit</label>
                                            <select name="unit" id="unit" class="form-control" required >
                                                <option value="">Select Unit</option>
                                                @foreach($units as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $product->unit_id){ echo 'selected'; } ?> >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="alert_quantity" class="form-label">Alert Quantity</label>
                                            <input type="number" class="form-control" id="alert_quantity" name="alert_quantity" required value="{{ $product->alert_quantity }}" >
                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="tax_method" class="form-label">Tax Method</label>
                                            <select name="tax_method" id="tax_method" class="form-control">
                                                <option value="1" <?php if($product->tax_method == 1){ echo 'selected'; } ?> >Exclusive</option>
                                                <option value="2" <?php if($product->tax_method == 2){ echo 'selected'; } ?> >Inclusive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="product_tax" class="form-label">Product Tax</label>
                                            <select name="product_tax" id="product_tax" class="form-control" required >
                                                <option value="">Select Product Tax</option>
                                                @foreach($taxes as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $product->taxes){ echo 'selected'; } ?> >{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control" required >
                                                <option value="1" <?php if($product->status == 1){ echo 'selected'; } ?> >Active</option>
                                                <option value="0" <?php if($product->status == 0){ echo 'selected'; } ?> >Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" style="height:200px" >{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ route('customer.products.list') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </form>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
</div>
@stop
@section('footer')
<script src="{{ asset('') }}assets/js/pages/password-addon.init.js"></script>
<script src="{{ asset('') }}assets/libs/inputmask/jquery.inputmask.min.js"></script>
@stop
