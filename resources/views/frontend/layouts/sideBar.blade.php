<div class="col-md-3 rsidebar">
    <form method="POST" action="{{ url('productLoad') }}" id="productLoad">
        {{ csrf_field() }}
        <input type="hidden" name="product_category_id" value="{{ $product_category_id }}">
        <input type="hidden" name="product_sub_category_id" value="{{ $product_sub_category_id }}">
        <input type="hidden" name="product_brand_id" value="{{ $product_brand_id }}">
        <input type="hidden" name="preOrder" value="{{ $preOrder }}">
        <input type="hidden" name="user" value="{{ $user }}">
        <input type="hidden" name="company" value="{{ $company }}">
        <input type="hidden" name="searchText" value="{{ $searchText }}">
        <div class="rsidebar-top">
            <div class="sidebar-row">
                <h4>Filter By Price</h4>
                <div class="row row1 scroll-pane">
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="price" id="price" value="10-100"@if($price === '10-100') checked="checked" @endif><i></i>Tk10 - Tk100</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="price" id="price" value="101-500"@if($price === '101-500') checked="checked" @endif><i></i>Tk101 - Tk500</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="price" id="price" value="501-1000"@if($price === '501-1000') checked="checked" @endif><i></i>Tk501 - Tk1000</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="price" id="price" value="1001-5000"@if($price === '1001-5000') checked="checked" @endif><i></i>Tk1001 - Tk5000</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="price" id="price" value="5001-10000"@if($price === '5001-10000') checked="checked" @endif><i></i>Tk5001 - Tk10000</label>
                </div>
            </div>
            <div class="sidebar-row">
                <h4>DISCOUNTS</h4>
                <div class="row row1 scroll-pane">
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="discount" id="discount" value="31-50"@if($discount === '31-50') checked="checked" @endif><i></i>31% - 50%</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="discount" id="discount" value="21-30"@if($discount === '21-30') checked="checked" @endif><i></i>21% - 30%</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="discount" id="discount" value="11-20"@if($discount === '11-20') checked="checked" @endif><i></i>11% - 20%</label>
                    <label class="checkbox"><input onChange="this.form.submit()" type="radio" name="discount" id="discount" value="5-10"@if($discount === '5-10') checked="checked" @endif><i></i>5% - 10%</label>
                </div>
            </div>           
        </div>
    </form>
</div>
<div class="clearfix"> </div>