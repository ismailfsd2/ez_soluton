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
                        <h4 class="card-title mb-0 flex-grow-1">Update Employee</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('customer.employees.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="f_name" class="form-label">First Name</label>
                                            <input type="hidden" name="employee_id" value="{{ $employee[0]->id}}">
                                            <input type="hidden" name="user_id" value="{{ $user[0]->id}}">
                                            <input type="text" class="form-control" id="f_name" name="fname" required value="{{ $employee[0]->first_name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="l_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="l_name" name="lname" required value="{{ $employee[0]->last_name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required value="{{ $employee[0]->email}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(+44)000-000-0000" required value="{{ $employee[0]->phone}}">
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
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('customer.employees.list') }}" class="btn btn-danger">Cancel</a>
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
