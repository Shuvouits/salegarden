<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;

class ProductCategoryController extends Controller {

    public function preOrderProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_division', 'PreOrder')
                ->where('product_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = $id;
        $product_brand_id = '';
        $preOrder = 'PreOrder';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.categoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function allProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = $id;
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.categoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function userProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'User')
                ->where('product_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = $id;
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = 'User';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.categoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function companyProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'Company')
                ->where('product_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = $id;
        $product_brand_id = '';
        $preOrder = '';
        $company = 'Company';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.categoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function preOrderSubProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_division', 'PreOrder')
                ->where('product_sub_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = $id;
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = 'PreOrder';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.subCategoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function userSubProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'User')
                ->where('product_sub_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = $id;
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = 'User';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.subCategoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function companySubProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'Company')
                ->where('product_sub_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = $id;
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = 'Company';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.subCategoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function allSubProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_sub_category_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = $id;
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.subCategoryList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function preOrderBrandProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_division', 'PreOrder')
                ->where('product_brand_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = $id;
        $preOrder = 'PreOrder';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.brandList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function allBrandProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_brand_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = $id;
        $preOrder = '';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.brandList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function userBrandProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'User')
                ->where('product_brand_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = $id;
        $preOrder = '';
        $company = '';
        $user = 'User';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.brandList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function companyBrandProduct($id) {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'Company')
                ->where('product_brand_id', $id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = $id;
        $preOrder = '';
        $company = 'Company';
        $user = '';
        $price = '';
        $discount = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.brandList', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

}
