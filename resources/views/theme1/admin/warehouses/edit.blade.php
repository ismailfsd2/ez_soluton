@extends('theme1.admin.layout')
@section('header')
@stop
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Warehouse</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('admin.warehouses.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="name" class="form-label">Name</label>
                                            <input type="hidden" name="warehouse_id" value="{{ $warehouse[0]->id}}">
                                            <input type="text" class="form-control" id="name" name="name" required value="{{ $warehouse[0]->name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required value="{{ $warehouse[0]->email}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(+44)000-000-0000" required value="{{ $warehouse[0]->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required value="{{ $warehouse[0]->address}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="type" class="form-label">Type</label>
                                            <select name="type" class="form-control" >
                                                <option value="1" <?php if($warehouse[0]->type == 1){ echo 'selected'; } ?> >Physical Warehouse</option>
                                                <option value="0" <?php if($warehouse[0]->type == 0){ echo 'selected'; } ?> >Virtual Warehouse</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-control" >
                                                <option value="1" <?php if($warehouse[0]->status == 1){ echo 'selected'; } ?> >Active</option>
                                                <option value="0" <?php if($warehouse[0]->status == 0){ echo 'selected'; } ?> >Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.warehouses.list') }}" class="btn btn-danger">Cancel</a>
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
    <script>
        $('#phone').inputmask("(99) 999 999 9999")
    </script>
@stop
