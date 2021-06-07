@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">product List</div>
                        <div class="panel-body">
                            @if (session('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ session('error') }}</strong>
                            </div>
                            @endif
                            <div class="box-body table-responsive no-padding">
                                <table id="tableList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                    <thead style="background: #E4E3E2;">
                                        <tr>
                                            <th>Title</th>
                                            <th>Product No</th>
                                            <th>Price</th>
                                            <th>Mobile No</th>
                                            <th>Product Division</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataList as $data)
                                        <tr>
                                            <td>{{ $data->product_title }}</td>
                                            <td>{{ $data->product_no }}</td>
                                            <td>{{ $data->product_price }}</td>
                                            <td>{{ $data->product_mobile }}</td>
                                            <td>{{ $data->product_division }}</td>
                                            <td>
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#Details{{ $data->product_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-eye"></i>&nbsp;Details</button>
                                                </a>
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#active{{ $data->product_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-check"></i>&nbsp;Activate</button>
                                                </a>
                                                @if($data->product_featured === 'Featured')
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#normal{{ $data->product_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i>&nbsp;Remove Featured</button>
                                                </a>
                                                @else
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#featured{{ $data->product_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-check"></i>&nbsp;Make Featured</button>
                                                </a>
                                                @endif
                                                <a href="{{ URL::to('portal/product/adminImage/'.$data->product_track_id) }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-search-minus"></i>&nbsp;Image</button>
                                                </a>
                                                <a href="{{ URL::to('portal/product/review/'.$data->product_track_id) }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-eye-slash"></i>&nbsp;Review List</button>
                                                </a>
                                                <a style="color: red;" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $data->product_track_id }}">
                                                    <i class="fa fa-trash"></i>&nbsp;Delete
                                                </a>
                                                <div id="normal{{ $data->product_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/product/normal') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title" style="color: red;">Are you sure you want to remove featured from this product?</h5>
                                                                    <input type="hidden" id="product_track_id" name="product_track_id" value="{{ $data->product_track_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Remove Featured</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="featured{{ $data->product_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/product/featured') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title">Are you sure you want to add featured in this product?</h5>
                                                                    <input type="hidden" id="product_track_id" name="product_track_id" value="{{ $data->product_track_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary center-block"><i class="fa fa-check"></i>&nbsp;Make Featured</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="active{{ $data->product_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/product/activate') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title">Are you sure you want to activate?</h5>
                                                                    <input type="hidden" id="product_track_id" name="product_track_id" value="{{ $data->product_track_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-success center-block"><i class="fa fa-check"></i>&nbsp;Activate</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div id="Details{{ $data->product_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">"{{ $data->product_title }}" - Product Details  </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-responsive table-striped table-bordered">
                                                                    <tr>
                                                                        <th style="width: 30%;">Category</th>
                                                                        <td style="width: 70%;">{!! $data->category_name !!}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Sub Category</th>
                                                                        <td style="width: 70%;">{!! $data->sub_category_name !!}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Brand</th>
                                                                        <td style="width: 70%;">{{ $data->brand_name }}</td>
                                                                    </tr>
                                                                    @if($data->product_featured === 'Featured')
                                                                    <tr>
                                                                        <th style="width: 30%;">Type</th>
                                                                        <td style="width: 70%;">Featured</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th style="width: 30%;">Country</th>
                                                                        <td style="width: 70%;">{{ $data->product_country }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Description</th>
                                                                        <td style="width: 70%;">{!! $data->product_description !!}</td>
                                                                    </tr>
                                                                    @if(!empty($data->product_order_date))
                                                                    <tr>
                                                                        <th style="width: 30%;">Last Date To Order</th>
                                                                        <td style="width: 70%;">{{ $data->product_order_date }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th style="width: 30%;">Discount</th>
                                                                        <td style="width: 70%;">{{ $data->product_discount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Discount Price</th>
                                                                        <td style="width: 70%;">{{ $data->product_discount_price }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Negotiable</th>
                                                                        <td style="width: 70%;">{{ $data->product_negotiable }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Created At</th>
                                                                        <td style="width: 70%;">{{ $data->created_at }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width: 30%;">Updated At</th>
                                                                        <td style="width: 70%;">{{ $data->updated_at }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="delete{{ $data->product_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/product/delete') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title" style="color: red;">Are you sure to delete this product?</h5>
                                                                    <input type="hidden" id="product_track_id" name="product_track_id" value="{{ $data->product_track_id }} " />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    </section>
</div>
@include('backend/layouts/footerScript')
<script type="text/javascript">
    $("#menu12").addClass("active");
    $("#menu12").parent().parent().addClass("treeview active");
    $("#menu12").parent().addClass("in");
</script>
<script>
    $(document).ready(function () {
        $('#tableList').DataTable({
            "aaSorting": [],
            "columnDefs": [{
                    "targets": 'sorting_disabled',
                    "orderable": false
                }]
        });
    });
</script>
@stop