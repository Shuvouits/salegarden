<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;

class HomeController extends Controller {

    public function home() {
        
        $newList = ProductModel::where('product_status', 'Active')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $popularList = ProductModel::where('product_status', 'Active')
                ->orderBy('product_view', 'DESC')
                ->paginate(12);
        $featureList = ProductModel::where('product_status', 'Active')
                ->where('product_featured', 'Featured')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);

        $preOrderList = ProductModel::where('product_division', 'PreOrder')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        return view('frontend.pages.index', compact('newList', 'popularList', 'featureList', 'preOrderList'));
    }

    public function productLoad(Request $request) {

        $dataList = ProductModel::where('product_id', '>', 0);

        $product_category_id = '';
        $product_sub_category_id = '';
        $preOrder = '';
        $company = '';
        $user = '';
        $product_brand_id = '';
        $price = '';
        $discount = '';
        $searchText = '';

        if (!empty($request->get('product_category_id'))) {
            $product_category_id = $request->get('product_category_id');
            $dataList->where('product_status', 'Active')
                    ->where('product_category_id', $product_category_id);
        }

        if (!empty($request->get('product_sub_category_id'))) {
            $product_sub_category_id = $request->get('product_sub_category_id');
            $dataList->where('product_status', 'Active')
                    ->where('product_sub_category_id', $product_category_id);
        }

        if (!empty($request->get('PreOrder'))) {
            $preOrder = 'PreOrder';
            $dataList->where('product_status', 'Active')
                    ->where('product_division', 'PreOrder');
        }

        if (!empty($request->get('Company'))) {
            $company = 'Company';
            $dataList->where('product_status', 'Active')
                    ->where('product_users_type', 'Company');
        }
        if (!empty($request->get('User'))) {
            $user = 'User';
            $dataList->where('product_status', 'Active')
                    ->where('product_users_type', 'User');
        }

        if (!empty($request->get('product_brand_id'))) {
            $product_brand_id = $request->get('product_brand_id');
            $dataList->where('product_status', 'Active')
                    ->where('product_brand_id', $product_brand_id);
        }

        if (!empty($request->get('searchText'))) {
            $searchText = $request->get('searchText');
            $dataList->where('product_status', 'Active')
                    ->where('product.product_title', 'LIKE', '%' . $searchText . '%');
        }
        if ($request->get('price')) {
            $price = $request->get('price');
            $priceSlice = explode("-", $price);
            $dataList->where('product_status', 'Active')
                    ->whereBetween('product_price', array($priceSlice[0], $priceSlice[1]));
        }

        if ($request->get('discount')) {
            $discount = $request->get('discount');
            $discountSlice = explode("-", $discount);
            $dataList->where('product_status', 'Active')
                    ->whereBetween('product_discount_percentage', array($discountSlice[0], $discountSlice[1]));
        }
        $dataList = $dataList->orderBy('created_at', 'DESC')->paginate(50);

        if (!empty($product_category_id)) {
            return view('frontend.pages.categoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
        } else if (!empty($product_sub_category_id)) {
            return view('frontend.pages.subCategoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
        } else if (!empty($product_brand_id)) {
            return view('frontend.pages.brandList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
        } else {
            return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
        }
    }

}
