@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">All admin list</div>
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
                                                <th>Username</th>                                                
                                                <th>Mobile No</th>
                                                <th>Type</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th class="sorting_disabled">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dataList as $data)
                                            <tr>
                                                <td>
                                                    {{ $data->users_name }}<br>
                                                    @if(!empty($data->users_email))
                                                    <i class="fa fa-envelope"></i> {{ $data->users_email }}<br>
                                                    @endif
                                                </td>

                                                <td>{{ $data->users_username }}</td>
                                                <td>{{ $data->users_mobile }}</td>
                                                <td>
                                                    {{ $data->users_type }}
                                                </td>
                                                <td>
                                                    @if($data->users_image != '')
                                                    <img style="width: 100px;height: 60px;" class="thumbnail img-responsive" src="{{ asset('upload/frontend/users_image/'.$data->users_image ) }}"/>
                                                    @else
                                                    <span class="label label-danger">No image added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $data->users_status }}
                                                </td>
                                                <td>
                                                <a href="{{ url('portal/admin/reset/'.$data->users_track_id) }}">
                                                        <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Reset Password</button>
                                                    </a><br>

                                                    @if ($data->users_status === 'Submitted' || $data->users_status === 'Pending' )
                                                    <a id="actionStyle" href="javascript:void(0)"  data-toggle="modal" data-target="#rejectAdmin" type="button" style="color: red">
                                                        <i class="fa fa-times-circle-o"></i> Inactivate
                                                    </a>
                                                    <br>
                                                    <a id="actionStyle" onclick="return confirm('Are you sure?')" href="{{ (!empty($data->users_track_id)) ? URL::to('portal/user/activate/'.$data->users_track_id) : '' }}">
                                                        <i class="fa fa-check-circle-o"></i> Activate
                                                    </a>
                                                    @elseif($data->users_status === 'Active')  
                                                    <a id="actionStyle" href="javascript:void(0)"  data-toggle="modal" data-target="#rejectAdmin{{ $data->users_track_id }}" type="button"  style="color: red">
                                                        <i class="fa fa-times-circle-o"></i> Inactivate
                                                    </a>
                                                    @else
                                                    <a id="actionStyle" onclick="return confirm('Are you sure?')" href="{{ (!empty($data->users_track_id)) ? URL::to('portal/user/activate/'.$data->users_track_id) : '' }}">
                                                        <i class="fa fa-check-circle-o"></i> Activate
                                                    </a>
                                                    @endif
                                                    <!-- Modal for Rejection note -->
                                                    <div class="modal fade" id="rejectAdmin{{ $data->users_track_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="">Rejection note</h4>
                                                                </div>
                                                                <form method="post" action="{{ url('portal/user/inActivate') }}" id="adminReject" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div>
                                                                                    <label for="users_rejection_note" style="width :100%">Rejection note&nbsp;<span style="color: red">*</span></label>
                                                                                    <input type="hidden" id="users_track_id" name="users_track_id" value="{{ $data->users_track_id }}" />
                                                                                    <textarea class="form-control" type="text" name="users_rejection_note" id="users_rejection_note" required style="width :100%"></textarea>
                                                                                </div><br>
                                                                                <button type="submit" id="btnDelete" name="btnDelete" id="rejectAdminNote" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Reject</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center" colspan="7"></td>
                                                <td class="text-left" colspan="1">
                                                    <a href="{{ URL::to('portal/admin/add') }}">
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add new</button>
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
    $("#menu3").addClass("active");
    $("#menu3").parent().parent().addClass("treeview active");
    $("#menu3").parent().addClass("in");
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