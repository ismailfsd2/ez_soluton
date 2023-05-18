@extends('theme1.admin.layout')
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
                                    <a class="nav-link" href="{{ route('admin.orders.list') }}">Orders</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="OrdersTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference No</th>
                                    <th>Customer</th>
                                    <th>Vendor</th>
                                    <th>Total Item</th>
                                    <th>Sub Total</th>
                                    <th>Last Update</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rows as $key => $row)
                                    <tr>
                                        <td>{{ $row->created_at }}</td>
                                        <td>#{{ Helper::decimal_val($row->id) }}</td>
                                        <td>{{ $row->customer }}</td>
                                        <td>{{ $row->vendor }}</td>
                                        <td>{{ $row->total_items }}</td>
                                        <td>{{ $row->sub_total }}</td>
                                        <td>{{ $row->updated_at }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item remove-item-btn" href="{{ route('admin.orders.detail',$row->id) }}"><i class=" ri-file-list-fill align-bottom me-2 text-muted"></i> view</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

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
            selector:'#OrdersTable',
        });
    </script>
@stop
