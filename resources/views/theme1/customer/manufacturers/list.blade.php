@extends('theme1.customer.layout')
@section('header')
  <!--datatable css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@stop
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="flex-shrink-0">
                            <ul class="nav nav-pills card-header-pills" role="tablist" style="float: left;">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('customer.employees.list') }}">Employees</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('customer.vendors.list') }}">Vendors</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('customer.customers.list') }}">Customers</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="{{ route('customer.manufacturers.list') }}">Manufacturers</a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills card-header-pills" role="tablist" style="float: right;">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="{{ route('customer.manufacturers.add') }}" style="background: #009edc;" ><i class="bx bx-user-plus"></i> Add Manufacturer</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="ManufacturerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Type Payer</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>FDA Licenses</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div>
@stop
@section('footer')
<!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatables.init.js"></script>
    <script>
        $.DataTableInit({
            selector:'#ManufacturerTable',
            url: "{{ route('customer.manufacturers.data') }}",
            data:{},
            config:{
                processing:true
            },
        });
    </script>
@stop
