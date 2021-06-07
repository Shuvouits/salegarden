<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;
use Illuminate\Support\Facades\Input;
use App\ProductImageModel;

class AdminProductController extends Controller {

    public function showActiveList() {
        $dataList = ProductModel::leftJoin('category', 'product.product_category_id', 'category.category_track_id')
                ->leftJoin('sub_category', 'product.product_sub_category_id', 'sub_category.sub_category_track_id')
                ->leftJoin('brand', 'product.product_brand_id', 'brand.brand_track_id')
                ->where('product.product_status', 'Active')
                ->select('product.*', 'category.category_name', 'sub_category.sub_category_name', 'brand.brand_name')
                ->orderBy('product.created_at', 'DESC')
                ->get();
        return view('backend.pages.product.activeList', compact('dataList'));
    }

    public function showInactiveList() {
        $dataList = ProductModel::leftJoin('category', 'product.product_category_id', 'category.category_track_id')
                ->leftJoin('sub_category', 'product.product_sub_category_id', 'sub_category.sub_category_track_id')
                ->leftJoin('brand', 'product.product_brand_id', 'brand.brand_track_id')
                ->where('product.product_status', 'Inactive')
                ->select('product.*', 'category.category_name', 'sub_category.sub_category_name', 'brand.brand_name')
                ->orderBy('product.created_at', 'DESC')
                ->get();
        return view('backend.pages.product.inactiveList', compact('dataList'));
    }

    public function activate(Request $request) {
        $id = Input::get('product_track_id');
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $dataList->product_status = 'Active';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Product successfully activated');
        }
    }

    public function featured(Request $request) {
        $id = Input::get('product_track_id');
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $dataList->product_featured = 'Featured';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Product successfully added into featured');
        }
    }

    public function normal(Request $request) {
        $id = Input::get('product_track_id');
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $dataList->product_featured = 'Normal';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Product successfully removed from featured');
        }
    }

    public function inactivate(Request $request) {
        $id = Input::get('product_track_id');
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $dataList->product_status = 'Inactive';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Product successfully inactivated');
        }
    }

    public function delete(Request $request) {
        $id = Input::get('product_track_id');
        ProductModel::where('product_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Product successfully deleted');
    }

    public function imageList($id) {
        $imageList = ProductModel::where('product_track_id', $id)->first()->product_status;
        $dataList = ProductImageModel::where('product_image_product_id', $id)->get();
        return view('backend.pages.product.image', compact('dataList', 'imageList'));
    }

}
