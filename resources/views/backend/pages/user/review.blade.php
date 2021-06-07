@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">All Review Of {{ $productList->product_title }}</div>
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
                                            <th>Total Star</th>
                                            <th>Details</th>
                                            <th class="no-sort">Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataList as $data)
                                        <tr>
                                            <td>{{ $data->review_star }}</td>
                                            <td>{{ $data->review_details }}</td>
                                            <td>
                                                @if($data->review_status == 'Active')
                                                <span class="label label-default"> {{ $data->review_status }} </span>
                                                @else
                                                <span class="label label-danger"> {{ $data->review_status }} </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->review_status === 'Active')
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#inactvate{{ $data->review_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i>&nbsp;Inactivate</button>
                                                </a>
                                                @else
                                                <a href="javascript:void0();" data-toggle="modal" data-target="#active{{ $data->review_track_id }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-check"></i>&nbsp;Activate</button>
                                                </a>
                                                @endif
                                                <div id="inactvate{{ $data->review_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/review/inactivate') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title" style="color: red;">Are you sure you want to inactivate?</h5>
                                                                    <input type="hidden" id="review_track_id" name="review_track_id" value="{{ $data->review_track_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Inactivate</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="active{{ $data->review_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/review/activate') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title">Are you sure you want to activate?</h5>
                                                                    <input type="hidden" id="review_track_id" name="review_track_id" value="{{ $data->review_track_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-success center-block"><i class="fa fa-check"></i>&nbsp;Activate</button>
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
    $("#menu10").addClass("active");
    $("#menu10").parent().parent().addClass("treeview active");
    $("#menu10").parent().addClass("in");
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