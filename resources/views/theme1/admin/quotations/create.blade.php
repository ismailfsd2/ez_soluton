@extends('theme1.admin.layout')
@section('header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@stop


@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.quotations.store') }}" method="post">
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
                                    <div class="mt-3">
                                        <label for="autoCompleteFruit">Select Raw Material</label><br>
                                        <input type="text" class="form-control bg-light border-0" id="searchproduct"  placeholder="Enter Name or Barcode" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off">
                                        <div id="suggesstion-box"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <table class="table" id="itemTable">
                                        <thead>
                                            <tr>
                                                <th style="width:150px">Product ID</th>
                                                <th style="width:200px">Product Barcode</th>
                                                <th>Product Name</th>
                                                <th style="width:250px">Vendor</th>
                                                <th style="width:150px">Quantity</th>
                                                <th style="width:150px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-5">
                                    <h4>Add-On Materails</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="invoice-table table table-borderless table-nowrap mb-0">
                                            <thead class="align-middle">
                                                <tr class="table-active">
                                                    <th scope="col">
                                                        Material Details
                                                    </th>
                                                    <th scope="col" style="width: 120px;">Quantity</th>
                                                    <th scope="col" class="text-end" style="width: 105px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="newlink">
                                            </tbody>
                                            <tbody>
                                                <tr id="newForm" style="display: none;"><td class="d-none" colspan="5"><p>Add New Form</p></td></tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <a href="javascript:new_link()" id="add-item" class="btn btn-soft-secondary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end table-->                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hstack gap-2 justify-content-start mt-5">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('admin.quotations.list') }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('footer')
<!-- <script src="{{ asset('') }}assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script> -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="{{ asset('') }}assets/js/pages/invoicecreate.init.js"></script>
<script>
        $("#searchproduct").autocomplete({
            source: function (request, response) {
                var supplier = $('#supplier').val();
                $.ajax({
                    type: 'get',
                    url: '{{ route("admin.general.searching.products") }}',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                var items = localStorage.getItem('quotation_items');
                if(items == null){
                    items = [ui.item];
                    localStorage.setItem('quotation_items',JSON.stringify(items));
                }
                else{
                    var getitems = JSON.parse(localStorage.getItem('quotation_items'));
                    getitems.push(ui.item);
                    localStorage.setItem('quotation_items', JSON.stringify(getitems));
                }
                loaditems()
                $("#searchproduct").val("");


            }
        });
        loaditems();
        function loaditems(){
            var items = JSON.parse(localStorage.getItem('quotation_items'));;
            var html = "";
            $.each(items, function(index) {
                var item = this;
                console.log(item);
                html += "<tr id='tr_"+item.row.id+"' >";
                    html += "<input type='hidden' name='item_id[]' value='"+item.row.id+"' >";
                    html += "<td>"+item.row.id+"</td>";
                    html += "<td>"+item.row.barcode+"</td>";
                    html += "<td>"+item.row.name+"</td>";
                    html += "<td>";
                        html += "<select class='form-control vendorTxt' name='item_vendor[]' data-index='"+index+"'>";
                        $.each(item.vendors, function(index2) {
                            var vendor = this;
                            html += "<option>"+vendor.name+"</option>";
                        });
                        html += "</select>";
                    html += "</td>";
                    html += "<td>";
                        html += "<input type='number' min='1' value='"+item.qty+"' class='form-control qtyTxt' data-index='"+index+"'>"
                    html += "</td>";
                    html += "<td><button type='button' class='btn btn-danger waves-effect waves-light removeItem' data-index='"+index+"' >Delete</button></td>";
                html += "</tr>";
            });
            $('#itemTable tbody').html(html);
        }
        $(document).on('click','.removeItem',function(){
            var index = parseInt($(this).data('index'));
            var getitems = JSON.parse(localStorage.getItem('quotation_items'));
            getitems.splice(index,1);
            localStorage.setItem('quotation_items', JSON.stringify(getitems));
            loaditems();
        });
        $(document).on('change','.qtyTxt',function(){
            var qty = $(this).val();
            var index = parseInt($(this).data('index'));
            var getitems = JSON.parse(localStorage.getItem('quotation_items'));
            getitems[index].qty = qty;
            localStorage.setItem('quotation_items', JSON.stringify(getitems));
        });


</script>
@stop
