<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;
use App\ProductImageModel;
use App\User;
use App\ReviewModel;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller {

    public function productDetails($id) {
        $dataList = ProductModel::where('product_track_id', $id)
                ->leftJoin('users', 'product_users_id', 'users.users_track_id')
                ->leftJoin('brand', 'product_brand_id', 'brand.brand_track_id')
                ->select('*', 'users.users_mobile', 'brand.brand_name')
                ->first();

        $dataList->product_view = $dataList->product_view + 1;
        $dataList->save();

        $imageList = ProductImageModel::where('product_image_product_id', $id)->get();
        $relatedList = ProductModel::where('product_status', 'Active')
                ->where('product_category_id', $dataList->product_category_id)
                ->where('product_sub_category_id', $dataList->product_sub_category_id)
                ->where('product_brand_id', $dataList->product_brand_id)
                ->orderBy('created_at', 'DESC')
                ->get();

        $attachmentImage = ProductImageModel::where('product_image_product_id', $id)
                ->first();

        if (!empty($attachmentImage)) {
            $applicationImage = $attachmentImage->product_image_file;
        } else {
            $applicationImage = 'default.jpg';
        }


        $imageFolder = 'upload/frontend/product_image_file/';

        $review = ReviewModel::where('review_product_id', $id)->avg('review_star');
        $reviewList = ReviewModel::where('review_product_id', $id)->where('review_status', 'Active')->orderBy('created_at', 'DESC')->take(8)->get();
        return view('frontend.pages.single', compact('dataList', 'imageList', 'relatedList', 'review', 'reviewList', 'imageFolder', 'applicationImage'));
    }

    public function search(Request $request) {
        $searchText = Input::get('searchText');
        if (!empty($searchText)) {
            $dataList = ProductModel::where('product_title', 'LIKE', '%' . $searchText . '%')
                    ->where('product_status', 'Active')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(12);
            $product_sub_category_id = '';
            $product_category_id = '';
            $product_brand_id = '';
            $preOrder = '';
            $company = '';
            $user = '';
            $price = '';
            $discount = '';
            return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
        } else {
            return redirect()->back();
        }
    }

    public function allProduct() {
        $dataList = ProductModel::where('product_status', 'Active')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function brandList() {
        $dataList = ProductModel::where('product_status', 'Active')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function brandProduct($id) {
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

    public function userProduct() {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'User')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = '';
        $user = 'User';
        $price = '';
        $discount = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function companyProduct() {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_users_type', 'Company')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = '';
        $company = 'Company';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function preOrderProduct() {
        $dataList = ProductModel::where('product_status', 'Active')
                ->where('product_division', 'PreOrder')
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        $product_sub_category_id = '';
        $product_category_id = '';
        $product_brand_id = '';
        $preOrder = 'PreOrder';
        $company = '';
        $user = '';
        $price = '';
        $discount = '';
        $searchText = '';
        return view('frontend.pages.allProduct', compact('dataList', 'product_sub_category_id', 'product_category_id', 'product_brand_id', 'preOrder', 'company', 'user', 'price', 'discount', 'searchText'));
    }

    public function categoryList($id) {
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

    public function subCategoryList($id) {
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

}
