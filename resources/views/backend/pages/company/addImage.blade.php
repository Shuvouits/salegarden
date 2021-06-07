@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Add New Image
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <div class="col-md-12">

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
                                    <form method="POST" enctype="multipart/form-data" action="{{ URL::to('portal/product/storeImage') }}">
                                        {{ csrf_field() }}
                                        <div class="panel-group">
                                            <div class="panel-default">
                                                <div id="gallery_panel">
                                                    <input type="hidden" name="product_image_product_id" value="{{ $product_image_product_id }}" /> 
                                                    <div  class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Image &nbsp;<span id="mark">*</span>&nbsp;<small style="color: #1E4770"><i>[.jpg, .png, .jpeg, .gif format allowed]</i></small></label>
                                                            <input type="file" id="product_image_file" name="product_image_file" class="form-control"> 
                                                        </div> 
                                                        <div class="form-group">
                                                            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary pull-right"><i class="fa fa-check"></i>&nbsp;Submit</button>                                                         
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@if(Auth::user()->users_type === 'Company')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu8").addClass("active");
        $("#menu8").parent().parent().addClass("treeview active");
        $("#menu8").parent().addClass("in");
    });
</script>
@else
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu10").addClass("active");
        $("#menu10").parent().parent().addClass("treeview active");
        $("#menu10").parent().addClass("in");
    });
</script>
@endif
@stop