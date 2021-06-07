@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">All Contact List</div>
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
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Subject</th>
                                                <th class="sorting_disabled">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dataList as $data)
                                            <tr>
                                                <td>{{ $data->contact_name }}</td>
                                                <td>{{ $data->contact_email }} </td>
                                                <td>{{ $data->contact_phone }}</td>
                                                <td>{{ $data->contact_subject }}</td>
                                                <td>
                                                    <a id="actionStyle" href="javascript:void(0);" data-toggle="modal" data-target="#contactMessage{{ $data->contact_id }}">
                                                        <i class="fa fa-eye"></i> View Details
                                                    </a><br>
                                                    <a id="actionStyle" href="javascript:void(0);" data-toggle="modal" data-target="#contactDelete{{ $data->contact_id }}" style="color: red">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                    <div id="contactMessage{{ $data->contact_id }}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Details</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! $data->contact_message !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="contactDelete{{ $data->contact_id }}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ URL::to('portal/contact/delete') }}">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h5 class="modal-title" style="color: red;">Are you sure to delete?</h5>
                                                                        <input type="hidden" id="contact_id" name="contact_id" value="{{ $data->contact_id }} " />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
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