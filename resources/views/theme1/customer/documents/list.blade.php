@extends('theme1.customer.layout')
@section('header')
  <!--datatable css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/libs/dropzone/dropzone.css" type="text/css" />
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
                                    <a class="nav-link" href="#">Documents</a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills card-header-pills" role="tablist" style="float: right;">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="#" style="background: #009edc;" data-bs-toggle="modal" data-bs-target="#addmodale"><i class="bx bx-plus"></i> Upload New Documents</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="DocumentTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>File Type</th>
                                    <th>Upload Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                <tr>
                                    <td>{{ $document->title }}</td>
                                    <td>{{ $document->file_type }}</td>
                                    <td>{{ $document->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('customer.vendors.documents.destory',$document->id) }}" >Delete</a>
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
<div id="addmodale" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('customer.vendors.documents.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Upload Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12">
                            <input type="hidden" name="type" value="{{ $type }}" >
                            <input type="hidden" name="relative_id" value="{{ $relative_id }}" >
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-xxl-12 col-md-12 mt-2">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Upload</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
    <!-- dropzone min -->
    <script src="{{ asset('') }}assets/libs/dropzone/dropzone-min.js"></script>
    <script>
        $.DataTableInit({
            selector:'#DocumentTable'
        });
    </script>

@stop
