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
                        <h4 class="card-title mb-0 flex-grow-1">Create New Employee</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12">
                                <form action="{{ route('admin.employees.store') }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="f_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="f_name" name="fname" required  value="{{ old('fname') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="l_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="l_name" name="lname" required  value="{{ old('lname') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" required  value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required  value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" required  value="{{ old('username') }}">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required  value="{{ old('password') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ route('admin.employees.list') }}" class="btn btn-soft-success">Cancel</a>
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
@stop
