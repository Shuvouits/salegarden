@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">All Order List</div>
                        <div class="panel-body">
                            @if (session('success'))
                            <div class="alert alert-success"  id="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif
                            <div class="row">  
                                <div class="col-md-12">
                                    <table id="tableList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Customer Mobile</th>
                                                <th>Delivery Address</th>
                                                <th>Product Name</th>
                                                <th>Product Quantity</th>
                                                <th>Product Price</th>
                                                <th class="sorting_disabled">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dataList as $data)
                                            <tr>
                                                <td>{{ $data->order->order_name }}</td>
                                                <td>{{ $data->order->order_mobile }} </td>
                                                <td>{{ $data->order->order_address }}</td>
                                                <td>{{ $data->product->product_title }}</td>
                                                <td>{{ $data->quantity }}</td>
                                                <td>{{ $data->amount }}</td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('backend/layouts/footerScript')
<script type="text/javascript">
    $("#menu15").addClass("active");
    $("#menu15").parent().parent().addClass("treeview active");
    $("#menu15").parent().addClass("in");
</script>
<script>
    $(document).ready(function () {
        $('#tableList').DataTable({
            "aaSorting": [[0, "asc"]],
            "columnDefs": [{
                    "targets": 'sorting_disabled',
                    "orderable": false
                }]
        });
    });
</script>
@stop