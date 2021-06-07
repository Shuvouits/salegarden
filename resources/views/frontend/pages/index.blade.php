<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tree Plant</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!--=== Reset Css ===-->
    <link rel="stylesheet" href="{{ asset('frontend/css/normalize.css') }}">
    <!--=== Fontawesome icon ===-->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <!--=== All Css ===-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/component.css') }}" />
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('frontend/css/flexslider.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet" type="text/css" media="all" />

    <link href="{{asset('frontend/css/sidebar.css')}}" rel="stylesheet">
     <link href="{{asset('frontend/css/box-style.css')}}" rel="stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="upload/fab.ico">

    <!------new add link---->

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!----End new Link---->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="../../../../punlic/frontend/css/cdn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  



</head>




<body>
    <!--[if lt IE 8]>
                          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
                      <![endif]-->
    <!--===============================================================================-->
    @include('frontend/layouts/menuBar')
    <!--Latest Products-->
    <div class="new">
        
        <div class="container">
            
            
            
             <div class="" id="new-info-change">
                <div class="row">

                     <div class="col-md-3">
                        

                        <div class="sidenav" id="hellow">
                            <a href="{{ url('/') }}">Home</a>

                            


                            <button class="dropdown-btn">Brand
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-container">


                                @php
                                $brandList = App\BrandModel::where('brand_status', 'Active')->get();
                                @endphp
                                @foreach($brandList as $brand)
                                <a class="list" href="{{ url('brand/' . $brand->brand_track_id) }}">{{ $brand->brand_name }}</a></li>
                                @endforeach

                            </div>

                            @php
                            $categoryList = App\CategoryModel::where('category_status', 'Active')->get();
                            @endphp

                            @foreach($categoryList as $category)

                            <button class="dropdown-btn">{{ $category->category_name }}
                                <i class="fa fa-caret-down"></i>
                            </button>

                            <div class="dropdown-container">
                                @php
                                $subCategoryList = App\SubCategoryModel::where('sub_category_category_id', $category->category_track_id)->where('sub_category_status', 'Active')->get();
                                @endphp

                                @foreach($subCategoryList as $subCategory)
                                <a href="{{ url('subCategory/' . $subCategory->sub_category_track_id) }}">{{ $subCategory->sub_category_name }}</a>
                                @endforeach

                            </div>

                            @endforeach





                        </div>

                    </div>
                    
                     <div class="col-md-9">
                         
                         <div class='row'>
                            
                             <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                              <div class='col-md-4' style='border:1px solid black; height:50px; margin-top:40px'>
                                 
                             </div>
                             
                         </div>
                         
                       
                    </div>
                    
                     

                    

                </div>
            </div>


         <!--Latest Products-->
            <div class="new">
                <div class="container">
                    <div class="title-info">
                        <h3 class="title">New <span>Arrivals</span></h3>
                    </div>
                    <div class="new-info" >
                        @if(count($newList) > 0)
                        @foreach($newList as $new)
                        <div class="col-md-3 new-item popular-item  red-item">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @php
                                    $product_image = App\ProductImageModel::where('product_image_product_id', $new->product_track_id)->first();
                                    @endphp
                                    @if(!empty($product_image))
                                    <a href="{{ url('productDetails/' .$new->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt="" /></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$new->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt="" /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href="{{ url('order/' . $new->product_track_id) }}"> Add to cart</a></li>
                                            <!-- <li><a href="single.html">Quick View </a></li> -->
                                            <li><a href="{{ url('productDetails/' .$new->product_track_id ) }}">Show Details </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="new-bottom">
                                    <h5><a class="name" href="{{ url('productDetails/' .$new->product_track_id ) }}">{{ $new->product_title }}</a></h5>
                                    <div class="ofr">
                                        @if(!empty($new->product_discount_price))
                                        <p class="pric1"><del>Tk{{ $new->product_price }}</del></p>
                                        @endif
                                        <p><span class="item_price">Tk{{ $new->product_price - $new->product_discount_price }}</span></p>
                                        @if($new->product_review > '4')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                        </div>
                                        @elseif($new->product_review > '3')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($new->product_review > '2')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($new->product_review > '1')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($new->product_review > '0')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @else
                                        <div class="rating">
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        No Products added
                        @endif
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <!--//Latest Products-->
            
            
            
            
            
             <!--Popular Products-->
            <div class="new">
                <div class="container">
                    <div class="title-info">
                        <h3 class="title">Popular Products</h3>
                    </div>
                    <div class="new-info">
                        @if(count($popularList) > 0)
                        @foreach($popularList as $popular)
                        <div class="col-md-3 popular-item">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @php
                                    $product_image = App\ProductImageModel::where('product_image_product_id', $popular->product_track_id)->first();
                                    @endphp
                                    @if(!empty($product_image))
                                    <a href="{{ url('productDetails/' .$popular->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt="" /></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$popular->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt="" /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href="{{ url('order/' . $popular->product_track_id) }}"> Add to cart</a></li>
                                            <!-- <li><a href="single.html">Quick View </a></li> -->
                                            <li><a href="{{ url('productDetails/' .$popular->product_track_id ) }}">Show Details </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="new-bottom">
                                    <h5><a class="name" href="{{ url('productDetails/' .$popular->product_track_id ) }}">{{ $popular->product_title }} </a></h5>
                                    <div class="ofr">
                                        @if(!empty($popular->product_discount_price))
                                        <p class="pric1"><del>Tk{{ $popular->product_price }}</del></p>
                                        @endif
                                        <p><span class="item_price">Tk{{ $popular->product_price - $popular->product_discount_price }}</span></p>
                                        @if($popular->product_review > '4')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                        </div>
                                        @elseif($popular->product_review > '3')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($popular->product_review > '2')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($popular->product_review > '1')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($popular->product_review > '0')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @else
                                        <div class="rating">
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        No Products added
                        @endif
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <!--//Popular Products-->
            
            
             <!--Featured Products-->
            <div class="new">
                <div class="container">
                    <div class="title-info">
                        <h3 class="title">Featured Products</h3>
                    </div>
                    <div class="new-info">
                        @if(count($featureList) > 0)
                        @foreach($featureList as $feature)
                        <div class="col-md-3 popular-item">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @php
                                    $product_image = App\ProductImageModel::where('product_image_product_id', $feature->product_track_id)->first();
                                    @endphp
                                    @if(!empty($product_image))
                                    <a href="{{ url('productDetails/' .$feature->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt="" /></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$feature->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt="" /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href="{{ url('order/' . $feature->product_track_id) }}"> Add to cart</a></li>
                                            <!-- <li><a href="single.html">Quick View </a></li> -->
                                            <li><a href="{{ url('productDetails/' .$feature->product_track_id ) }}">Show Details </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="new-bottom">
                                    <h5><a class="name" href="{{ url('productDetails/' .$feature->product_track_id ) }}">{{ $feature->product_title }} </a></h5>
                                    <div class="ofr">
                                        @if(!empty($feature->product_discount_price))
                                        <p class="pric1"><del>Tk{{ $feature->product_price }}</del></p>
                                        @endif
                                        <p><span class="item_price">Tk{{ $feature->product_price - $feature->product_discount_price }}</span></p>
                                        @if($feature->product_review > '4')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                        </div>
                                        @elseif($feature->product_review > '3')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($feature->product_review > '2')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($feature->product_review > '1')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @elseif($feature->product_review > '0')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @else
                                        <div class="rating">
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        No Products added
                        @endif
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        
           
            
            
           
            
            
            
            @include('frontend/layouts/footer')
        </div>
       
    </div>



        <script src="{{asset('frontend/js/wow.min.js')}}"></script>


        <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
        <script src="{{ asset('frontend/js/simpleCart.min.js') }}"></script>
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>


        <script defer src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
        <script src="{{ asset('frontend/js/classie.js') }}"></script>
        <script src="{{ asset('frontend/js/uisearch.js') }}"></script>

        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>





        <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>


        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>








</body>

</html>