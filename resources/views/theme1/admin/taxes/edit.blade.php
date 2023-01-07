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
                        <h4 class="card-title mb-0 flex-grow-1">Update Tax</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('admin.taxes.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">Name</label>
                                                <input type="hidden" name="tax_id" value="{{ $tax[0]->id }}" >
                                                <input type="text" class="form-control" id="name" name="name" required value="{{ $tax[0]->name }}" >
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="type" class="form-label">Tax Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="1" <?php if($tax[0]->type==1){ echo 'selected'; } ?> >Percentage</option>
                                                    <option value="2" <?php if($tax[0]->type==2){ echo 'selected'; } ?> >Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="name" class="form-label">Tax Rate</label>
                                                <input type="text" class="form-control" id="rate" name="rate" required value="{{ $tax[0]->rate }}" >
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="type" class="form-label">Apply On</label>
                                                <select name="apply_on" id="apply_on" class="form-control">
                                                    <option value="0" <?php if($tax[0]->apply_on==0){ echo 'selected'; } ?> >All</option>
                                                    <option value="1" <?php if($tax[0]->apply_on==1){ echo 'selected'; } ?> >Non Register</option>
                                                    <option value="2" <?php if($tax[0]->apply_on==2){ echo 'selected'; } ?> >Register</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ route('admin.taxes.list') }}" class="btn btn-danger">Cancel</a>
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
