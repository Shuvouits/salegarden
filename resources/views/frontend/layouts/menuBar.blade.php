<!--header-->
<style type="text/css">

    .value-button {
        display: inline-block;
        border: 1px solid #ddd;
        margin: 0px;
        width: 40px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
        padding: 11px 0;
        background: #eee;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .value-button:hover {
        cursor: pointer;
    }
</style>

@php
$order = App\OrderModel::where('order_ip', $_SERVER['REMOTE_ADDR'])->whereDay('created_at', \Carbon\Carbon::now()->day)->where('order_status', 'Process')->first();
@endphp
<header class="header">
    <div class="header-two navbar navbar-default"><!--header-two-->
        <div class="container">
            <div class="nav navbar-nav header-two-left">
                <div class="menu-button">
                    <span class="menu-bar"></span>
                    <span class="menu-bar"></span>
                    <span class="menu-bar"></span>
                </div>

                <div class="mobile-menu-area">
                    <div class="menu-close">
                        <div class="menu-close-inner">
                            <span class="menu-bar-close"></span>
                            <span class="menu-bar-close"></span>
                        </div>
                    </div>
                    <ul class="mobile-menu">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('brandList') }}">BRANDS</a>
                            @php
                            $brandList = App\BrandModel::where('brand_status', 'Active')->get();
                            @endphp
                            <ul class="mobile-submenu">
                                @foreach($brandList as $brand)
                                <li><a href="{{ url('brand/' . $brand->brand_track_id) }}">{{ $brand->brand_name }}</a></li>
                                @endforeach
                            </ul>

                        </li>
                        @php
                        $categoryList = App\CategoryModel::where('category_status', 'Active')->get();
                        @endphp
                        @foreach($categoryList as $category)
                        <li><a href="{{ url('category/' . $category->category_track_id) }}">{{ $category->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <ul>
                    <li>
                        <div id="all-ads-button" class="all-ads-button">
                            <a href="{{ url('allProduct') }}"><span class="all-ads-text">01636-408000</span></a>
                            <span class="all-ads-border top"></span>
                            <span class="all-ads-border right"></span>
                            <span class="all-ads-border bottom"></span>
                            <span class="all-ads-border left"></span>
                        </div>
                    </li>
                    <li>
                        <!-- <a href="{{ url('contact') }}"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> CONTACT US</a> -->
                        <div id="all-ads-button" class="all-ads-button">
                            <a href="{{ url('allProduct') }}"><span class="all-ads-text">View Product</span></a>
                            <span class="all-ads-border top"></span>
                            <span class="all-ads-border right"></span>
                            <span class="all-ads-border bottom"></span>
                            <span class="all-ads-border left"></span>
                        </div>
                    </li>          
                </ul>
                <div class="menu-button-right">
                    <span class="menu-bar-right"></span>
                    <span class="menu-bar-right"></span>
                    <span class="menu-bar-right"></span>
                </div>
            </div>
            <div class="nav navbar-nav logo wow zoomIn animated" data-wow-delay=".7s">
                <h1><a href="http://laravel.anytuition.com/public">Tree<b>Plant</b> </a></h1>
            </div>
            @if(Auth::check())
            <div class="nav navbar-nav navbar-right header-two-right">
                <div class="header-right my-account">
                    <a href="{{ url('portal/profile') }}"><button class="btn btn-sm btn-primary">Account</button></a>
                    <a href="{{ url('logout') }}"><button class="btn btn-sm btn-danger">Log Out</button></a>
                </div>
                <div class="header-right cart">
                    <a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
                    <h4><a href="{{ url('/checkout') }}">
                            @if($order)
                            <span> Tk{{ $order->orderDetails()->sum('amount') }} </span> (<span id="simpleCart_quantity"> {{ $order->orderDetails()->count('id') }} </span>) 
                            @else
                            <span> Tk0.00 </span> (<span id="simpleCart_quantity"> 0 </span>) 
                            @endif
                        </a></h4>
                    <div class="cart-box">
                        <p><a href="{{ url('/checkout') }}" class="simpleCart_empty">View cart</a></p>
                        <div class="clearfix"> </div>
                    </div>
                </div> 
            </div>
            @else
            <div class="nav navbar-nav navbar-right header-two-right">
                <div class="btn-group header-right my-account">
                    <a href="{{ url('register') }}"><button class="btn btn-sm btn-primary">Register </button></a>
                    <a href="{{ url('portal/login') }}"><button class="btn btn-sm btn-primary">Sign In</button> </a>
                </div>
                <div class="header-right cart">
                    <a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
                    <h4><a href="{{ url('/checkout') }}">
                            @if($order)
                            <span > ${{ $order->orderDetails()->sum('amount') }} </span> (<span id="simpleCart_quantity"> {{ $order->orderDetails()->count('id') }} </span>) 
                            @else
                            <span > $0.00 </span> (<span id="simpleCart_quantity"> 0 </span>) 
                            @endif
                        </a></h4>
                    <div class="cart-box">
                        <p><a href="{{ url('/checkout') }}" class="simpleCart_empty">View cart</a></p>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            @endif
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="top-nav navbar navbar-default">
        <div class="container">
            <ul class="social-icons icon-rounded icon-rotate list-unstyled list-inline"> 
                <li> <a href="https://www.facebook.com/bengalsoft" target="_blank"><i class="fa fa-facebook"></i></a></li>  
                <li> <a href="{{ url('/contact') }}"><i class="fa fa-envelope"></i></a></li>   
            </ul>
            <div class="wrap">
                <div class="search">
                    <form method="GET" action="{{ url('search') }}">
                        <input type="text" id="searchText" name="searchText" class="searchTerm" placeholder="What are you looking for?">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"> Search</i>
                        </button>
                    </form>
                </div>
            </div>

           
        </div>
    </div>
</header>
<!--//header-->

<!-- Sidebar Cart -->

<ul class="widget">
    <li class="relative">
        <button class="widget_button">
            <i class="fa fa-shopping-bag"></i>
            @if($order)
            <p>{{ $order->orderDetails()->count('id') }} Items</p>
            <p class="color">Tk-{{ $order->orderDetails()->sum('amount') }}</p>
            @else
            <p>0 Items</p>
            <p class="color">Tk-0</p>
            @endif
        </button>
        <div class="widget_content">
            <div class="nav-header" style="display: inline-flex;">
                @if($order)
                <h3 clas="color_dark"> {{ $order->orderDetails()->count('id') }} Items </h3>
                @else
                <h3 class="color_dark"> 0 Items</h3>
                @endif
                <button class="close-nav btn btn-sm btn-danger" style="float: right;margin-left: 105px;"> Close X</button>
            </div>
            <hr>
            <div class="sidebar-cart-list">
                @if($order)
                @foreach($order->orderDetails as $orderDetail)

                <div class="sidebar-cart-header col-md-12">

                    <div class="col-md-6">
                        <div class="sidebar-cart-sec simplesidebar-cart_shelfItem">
                            <div class="sidebar-cart-item-info">
                                <h4> {{ $orderDetail->product ? $orderDetail->product->product_title : '' }}</h4>
                                <div class="sidebar-cart-info">
                                    <p>Price:Tk {{ $orderDetail->amount }}</p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form method="POST" action="{{ url('checkoutStore') }}" id="checkout{{ $orderDetail->id }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $orderDetail->id }}">
                            <select class="form-control" onchange="document.getElementById('checkout{{ $orderDetail->id }}').submit();" name="quantity" id="quantity">
                                <option value="">Select item No</option>
                                @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}"@if($i == $orderDetail->quantity) selected="selected" @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a href="#" title="Delete"
                           onclick="document.getElementById('deleteForm{{ $orderDetail->id }}').submit(); event.returnValue = false; return false;">
                            <img class="remove-icon" src="{{ asset('frontend/images/remove.png') }}" alt="">
                        </a>
                        <form method="POST" action="{{ URL('orderDestroy') }}" id="deleteForm{{ $orderDetail->id }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="order_detail_id" value="{{ $orderDetail->id }}">
                        </form> 
                    </div>
                </div>

                <div class="clearfix"></div>

                @endforeach
                @endif
            </div>
            <div class="order">
                @if($order)
                <h4>Total Price:Tk {{ $order->orderDetails()->sum('amount') }}</h4>
                @else
                <h4>Total Price:Tk 0</h4>
                @endif
                <a href="{{ url('checkout') }}"><button> Place Order  </button></a>
            </div>
        </div>
    </li>
</ul> 

<!-- //Sidebar Cart -->
