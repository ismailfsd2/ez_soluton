@extends('theme1.admin.layout')
@section('header')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h5 class="card-title mb-0">Customers</h5> -->
                        <div class="flex-shrink-0">
                            <ul class="nav nav-pills card-header-pills" role="tablist" style="float: left;">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active"href="#">Product Vendor's List</a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills card-header-pills" role="tablist" style="float: right;">
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.products.vendors.add') }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="category" class="form-label">Vendor</label>
                                                <input type="hidden" name="product_id" value="{{$id}}" >
                                                <select name="vendor" class="form-control vendor_select2" required>
                                                    <option value="">Select Vendor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="hstack gap-2 justify-content-start">
                                                <button type="submit" class="btn btn-primary mt-4">Add</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </form>
                            </div>
                            <div class="mt-5 col-md-12">
                                <table id="CustomerTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Vendor ID</th>
                                            <th>Vendor Name</th>
                                            <th>Assign Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vendors as $key => $vendor)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $vendor->vendor_id }}</td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.products.vendors.destroy',$vendor->id) }}" class="btn btn-danger waves-effect waves-light">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatables.init.js"></script>
    
    <script>
        $.DataTableInit({
            selector:'#CustomerTable',
        });

        $('.vendor_select2').select2({
            ajax: {
                url: '{{ route("admin.general.select.vendors") }}',
                dataType: 'json',
            },
            formatResult: function (data, term) {
                return data;
            },


        });
    </script>
@stop
