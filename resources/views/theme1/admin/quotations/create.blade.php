@extends('theme1.admin.layout')
@section('header')
@stop


@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="date-field">Date</label>
                                    <input type="text" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" placeholder="Select Date-time">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="date-field">Customer</label>
                                    <select name="" id="" class="form-control">
                                        @foreach($customers as $customer):
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3 mb-lg-0">
                                    <label for="date-field">Select Products</label>
                                    <input type="text" class="form-control bg-light border-0"  placeholder="Select Product">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('footer')
@stop
