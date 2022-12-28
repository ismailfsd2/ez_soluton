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
                        <h4 class="card-title mb-0 flex-grow-1">Create New POC</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('admin.customers.poc.update') }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="f_name" class="form-label">First Name</label>
                                            <input type="hidden" value="{{$poc[0]->id}}" name="id">
                                            <input type="text" class="form-control" id="f_name" name="f_name" required value="{{$poc[0]->first_name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="l_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="l_name" name="l_name" required value="{{$poc[0]->last_name}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="designation" class="form-label">Designation</label>
                                            <input type="text" class="form-control" id="designation" name="designation" required value="{{$poc[0]->designation}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required value="{{$poc[0]->email}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="working_phone" class="form-label">Working Phone</label>
                                            <input type="text" class="form-control" id="working_phone" placeholder="(+44)000-000-0000" name="working_phone" required value="{{$poc[0]->working_phone}}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="personal_phone" class="form-label">Personal Phone</label>
                                            <input type="text" class="form-control" id="personal_phone" placeholder="(+44)000-000-0000" name="personal_phone" required value="{{$poc[0]->personal_phone}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="10">{{$poc[0]->comment}}</textarea>
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
        $('#working_phone').inputmask("(99) 999 999 9999")
        $('#personal_phone').inputmask("(99) 999 999 9999")
    </script>
@stop
