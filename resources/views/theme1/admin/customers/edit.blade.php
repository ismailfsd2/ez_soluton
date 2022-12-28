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
                        <h4 class="card-title mb-0 flex-grow-1">Update Customer</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('admin.customers.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="f_name" class="form-label">Logo</label>
                                            <input type="file" class="form-control" id="logo" name="logo">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="f_name" class="form-label">Name</label>
                                            <input type="hidden" name="customer_id" value="{{ $customer[0]->id}}">
                                            <input type="hidden" name="user_id" value="{{ $user[0]->id}}">
                                            <input type="text" class="form-control" id="name" name="name" required value="{{ $customer[0]->name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required value="{{ $customer[0]->email}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" placeholder="(+44)000-000-0000" name="phone" required value="{{ $customer[0]->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="tex_payer" class="form-label">Tax Payer</label>
                                            <select name="tex_payer" class="form-control" id="tex_payer">
                                                <option value="0" @if($customer[0]->tax_payer == 0) selected @endif >No</option>
                                                <option value="1" @if($customer[0]->tax_payer == 1) selected @endif >Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="country" class="form-label">Country</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="United State" <?php if($customer[0]->country == "United State"){ echo "selected"; } ?> >United State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="state" class="form-label">State</label>
                                            <select name="state" id="state" class="form-control">
                                                <option value="Florida" <?php if($customer[0]->state == "Florida"){ echo "selected"; } ?> >Florida</option>
                                                <option value="Washington" <?php if($customer[0]->state == "Washington"){ echo "selected"; } ?> >Washington</option>
                                                <option value="Wisconsin" <?php if($customer[0]->state == "Wisconsin"){ echo "selected"; } ?> >Wisconsin</option>
                                                <option value="Wyoming" <?php if($customer[0]->state == "Wyoming"){ echo "selected"; } ?> >Wyoming</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="city" class="form-label">City</label>
                                            <select name="city" id="city" class="form-control">
                                                <option value="New York" <?php if($customer[0]->city == "New York"){ echo "selected"; } ?> >New York</option>
                                                <option value="Los Angeles" <?php if($customer[0]->city == "Los Angeles"){ echo "selected"; } ?> >Los Angeles</option>
                                                <option value="Chicago" <?php if($customer[0]->city == "Chicago"){ echo "selected"; } ?> >Chicago</option>
                                                <option value="Houston" <?php if($customer[0]->city == "Houston"){ echo "selected"; } ?> >Houston</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required value="{{ $customer[0]->addres}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" required value="{{ $user[0]->username}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="password-input" class="form-label">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password" required  value="{{ $user[0]->password}}">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="note" class="form-label">Note</label>
                                            <textarea name="note" id="note" class="form-control" cols="30" rows="10">{{ $user[0]->note}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ route('admin.customers.list') }}" class="btn btn-danger">Cancel</a>
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
