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
                        <h4 class="card-title mb-0 flex-grow-1">Create New Tax</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12">
                                <form action="{{ route('customer.taxes.store') }}" class="needs-validation" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required  value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="type" class="form-label">Tax Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="1">Percentage</option>
                                                    <option value="2">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">Tax Rate</label>
                                                <input type="text" class="form-control" id="rate" name="rate" required  value="{{ old('rate') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="type" class="form-label">Apply On</label>
                                                <select name="apply_on" id="apply_on" class="form-control">
                                                    <option value="0">All</option>
                                                    <option value="1">Non Register</option>
                                                    <option value="2">Register</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ route('customer.taxes.list') }}" class="btn btn-danger">Cancel</a>
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
            </div>
            <!--end col-->
        </div>
    </div>
</div>
@stop
@section('footer')
    <!-- password-addon init -->
    <script src="{{ asset('') }}assets/js/pages/password-addon.init.js"></script>
    <script src="{{ asset('') }}assets/libs/inputmask/jquery.inputmask.min.js"></script>
    <script>
        $('#phone').inputmask("(99) 999 999 9999")
    </script>
@stop
