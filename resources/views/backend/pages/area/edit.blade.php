@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Add  New area</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if (session('errorArray'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() AS $key => $value)
                                        <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if (session('error'))
                                    <div class="alert alert-danger"  id="error">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ url('portal/area/update') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="area_track_id" id="area_track_id" value="{{ $dataList->area_track_id }}" />
                                        <div class="form-group">
                                            <label for="area_name">Name&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="area_name" name="area_name" value="{{ $dataList->area_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="area_status">Status&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="area_status" name="area_status" required>
                                                <option value="">--</option>
                                                <option value="Active"@if('Active' == $dataList->area_status) selected="selected" @endif>Active</option>
                                                <option value="Inactive"@if('Inactive' == $dataList->area_status) selected="selected" @endif>Inactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Submit</button>
                                    </form>
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
    $("#menu4").addClass("active");
    $("#menu4").parent().parent().addClass("treeview active");
    $("#menu4").parent().addClass("in");
</script>
@stop