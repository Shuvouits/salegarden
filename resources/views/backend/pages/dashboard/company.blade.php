@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Dashboard</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="font-size: 20px;background: #8CC63F"> Total Product 
                                            <span class="badge" style="font-size: 20px;background: #662D91">{{ $product }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="font-size: 20px;background: #8CC63F"> Total PreOrder Product
                                            <span class="badge" style="font-size: 20px;background: #662D91">{{ $preOrderProduct }}</span>
                                        </li>
                                    </ul>
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
    $("#menu1").addClass("active");
    $("#menu1").parent().parent().addClass("treeview active");
    $("#menu1").parent().addClass("in");
</script>
@stop