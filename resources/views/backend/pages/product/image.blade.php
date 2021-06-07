@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Image List 
                        </div>
                        <div class="panel-body">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="item">
                                        <div class="row">
                                            @if(!empty($dataList))
                                            @foreach($dataList AS $data)
                                            <div class="col-xs-3" style="padding: 10px;">
                                                <img style="height: 200px;width: 100%" src="{{ asset('upload/frontend/product_image_file/'.$data->product_image_file ) }}" class="img-responsive">
                                            </div>
                                            @endforeach  
                                            @else
                                            No Image submitted Yet
                                            @endif  
                                        </div>
                                    </div>
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
@if($imageList === 'Active')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu11").addClass("active");
        $("#menu11").parent().parent().addClass("treeview active");
        $("#menu11").parent().addClass("in");
    });
</script>
@else
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu12").addClass("active");
        $("#menu12").parent().parent().addClass("treeview active");
        $("#menu12").parent().addClass("in");
    });
</script>
@endif
@stop