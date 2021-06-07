@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Brand List</div>
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
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th class="sorting_disabled">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dataList as $data)
                                            <tr>
                                                <td>{{ $data->brand_name }}</td>
                                                <td>{{ $data->brand_status }}</td>                                              
                                                <td>
                                                    <a href="{{ url('portal/brand/edit/'.$data->brand_track_id) }}">
                                                        <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                                    </a>&nbsp;
                                                    <a style="color: red;" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $data->brand_track_id }}">
                                                         <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div id="delete{{ $data->brand_track_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/brand/delete') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title" style="color: red;">Are you sure?</h5>
                                                                    <input type="hidden" id="brand_track_id" name="brand_track_id" value="{{ $data->brand_track_id }} " />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center" colspan="2"></td>
                                                <td class="text-left" colspan="1">
                                                    <a href="{{ URL::to('portal/brand/add') }}">
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  Add New</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tfoot>
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
    $("#menu16").addClass("active");
    $("#menu16").parent().parent().addClass("treeview active");
    $("#menu16").parent().addClass("in");
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