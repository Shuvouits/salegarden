<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProductModel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\CategoryModel;
use App\SubCategoryModel;
use App\ProductImageModel;
use App\RandomNumberModel;
use App\BrandModel;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use Image;

class UserProductController extends Controller {

    public function showList() {
        $dataList = ProductModel::leftJoin('category', 'product.product_category_id', 'category.category_track_id')
                ->leftJoin('sub_category', 'product.product_sub_category_id', 'sub_category.sub_category_track_id')
                ->leftJoin('brand', 'product.product_brand_id', 'brand.brand_track_id')
                ->where('product_users_id', Auth::user()->users_track_id)
                ->where('product_division', 'Normal')
                ->select('product.*', 'category.category_name', 'sub_category.sub_category_name', 'brand.brand_name')
                ->orderBy('product.created_at', 'DESC')
                ->get();
        return view('backend.pages.user.list', compact('dataList'));
    }

    public function add() {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $brandList = BrandModel::where('brand_status', 'Active')->get();
        return view('backend.pages.user.add', compact('categoryList', 'brandList'));
    }

    public function store(Request $request) {
        $product_title = Input::get('product_title');
        $product_category_id = Input::get('product_category_id');
        $product_sub_category_id = Input::get('product_sub_category_id');
        $product_price = Input::get('product_price');
        $product_description = Input::get('product_description');
        $product_brand_id = Input::get('product_brand_id');

        $product_mobile = Input::get('product_mobile');
        $product_discount = Input::get('product_discount');
        $product_discount_price = Input::get('product_discount_price');
        $product_negotiable = Input::get('product_negotiable');
        $product_country = Input::get('product_country');

        $errors = array();

        if (empty($product_title) || $product_title == '') {
            $errors[] = "Product title required";
        }
        if (!empty($product_title)) {
            if (strlen($product_title) > 19) {
                $errors[] = "Product title must be less than 19 character.";
            }
        }
        if (empty($product_category_id) || $product_category_id == '') {
            $errors[] = "Category required";
        }

        if (empty($product_sub_category_id) || $product_sub_category_id == '') {
            $errors[] = "Sub Category required";
        }
        if (empty($product_price) || $product_price == '') {
            $errors[] = "Price required";
        }
        if (empty($product_country) || $product_country == '') {
            $errors[] = "Product Country required";
        }
        if (!empty($product_price)) {
            if (!is_numeric($product_price)) {
                $errors[] = "Price must be numeric value";
            }
        }
        if (!empty($product_discount_price)) {
            if (!is_numeric($product_discount_price)) {
                $errors[] = "Discount Price must be numeric value";
            }
        }
        if (count($request->file('product_image_file')) > 0) {
            $img_name = $_FILES['product_image_file']['name'];
            $i = 0;
            if (count($_FILES['product_image_file']['name']) <= 20) {
                foreach (Input::file("product_image_file") as $file) {
                    $allowed = array('jpeg', 'png', 'jpg', 'JPG', 'PNG');
                    //process each file
                    $ext = pathinfo($img_name[$i]);
                    $ext = $ext['extension'];

                    if (!in_array($ext, $allowed)) {
                        $errors[] = "Only JPG, JPEG, PNG,format allowed";
                    }
                    if (File::size($file) > 2048000) {
                        $errors[] = "Image Size must be less than 2 MB.";
                    }
                }
            } else {
                $errors[] = "max 20 images allowed";
            }
        } else {
            $errors[] = "Image required";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "OL" . date('YmdHis');
            $productNo = $randomNumber->mobileVerification(4, 6) . date('His');

            $dataList = new ProductModel;
            $dataList->product_users_id = Auth::user()->users_track_id;
            $dataList->product_category_id = $product_category_id;
            $dataList->product_title = $product_title;
            $dataList->product_sub_category_id = $product_sub_category_id;
            $dataList->product_status = 'Inactive';
            $dataList->product_track_id = $trackId;
            $dataList->product_price = $product_price;
            $dataList->product_country = $product_country;
            $dataList->product_description = $product_description;
            $dataList->product_division = 'Normal';
            $dataList->product_brand_id = $product_brand_id;
            $dataList->product_users_type = 'User';

            if ($product_mobile === 'Yes') {
                $dataList->product_mobile = Auth::user()->users_mobile;
            } else {
                $dataList->product_mobile = '';
            }

            $dataList->product_discount = $product_discount;
            $dataList->product_discount_price = $product_discount_price;
            if (!empty($product_discount_price)) {
                $dataList->product_discount_percentage = int(($product_discount_price * 100) / $product_price);
            }
            $dataList->product_negotiable = $product_negotiable;
            $dataList->product_no = $productNo;
            $dataList->created_at = Carbon::now();

            if ($dataList->save()) {
                if (!empty(Input::file("product_image_file"))) {
                    $img_name = $_FILES['product_image_file']['name'];
                    $i = 0;
                    if (count($_FILES['product_image_file']['name']) <= 20) {
                        foreach (Input::file("product_image_file") as $file) {
                            //process each file
                            $image = $request->file('product_image_file')[$i];
                            $img = Image::make($image->getRealPath());
                            $imageName = $i . date('YmdHis') . rand(5, 10) . '.' . $request->product_image_file[$i]->getClientOriginalExtension();
                            $img->resize(261, 333)->save(('upload/frontend/product_image_file/') . $imageName);

                            $imageList = new ProductImageModel;
                            $imageList->product_image_file = $imageName;
                            $imageList->product_image_product_id = $trackId;
                            $imageList->created_at = Carbon::now();
                            $imageList->save();
                            $file->move(('upload/frontend/product_image_file'), $imageName);
                            $i++;
                        }
                    }
                }
                return redirect('portal/product/userList')->with('success', 'Product successfully submitted');
            }
        }
    }

    public function edit($id) {
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $subCategoryList = SubCategoryModel::where('sub_category_category_id', $dataList->product_category_id)
                        ->where('sub_category_status', 'Active')->get();
        $brandList = BrandModel::where('brand_status', 'Active')->get();
        return view('backend.pages.user.edit', compact('dataList', 'categoryList', 'subCategoryList', 'brandList'));
    }

    public function update(Request $request) {
        $product_track_id = Input::get('product_track_id');
        $product_title = Input::get('product_title');
        $product_category_id = Input::get('product_category_id');
        $product_sub_category_id = Input::get('product_sub_category_id');
        $product_price = Input::get('product_price');
        $product_description = Input::get('product_description');
        $product_brand_id = Input::get('product_brand_id');

        $product_mobile = Input::get('product_mobile');
        $product_discount = Input::get('product_discount');
        $product_discount_price = Input::get('product_discount_price');
        $product_negotiable = Input::get('product_negotiable');
        $product_country = Input::get('product_country');

        $errors = array();

        if (empty($product_title) || $product_title == '') {
            $errors[] = "Product title required";
        }
        if (!empty($product_title)) {
            if (strlen($product_title) > 19) {
                $errors[] = "Product title must be less than 19 character.";
            }
        }

        if (empty($product_category_id) || $product_category_id == '') {
            $errors[] = "Category required";
        }

        if (empty($product_sub_category_id) || $product_sub_category_id == '') {
            $errors[] = "Sub Category required";
        }
        if (empty($product_price) || $product_price == '') {
            $errors[] = "Price required";
        }
        if (empty($product_country) || $product_country == '') {
            $errors[] = "Product Country required";
        }
        if (!empty($product_price)) {
            if (!is_numeric($product_price)) {
                $errors[] = "Price must be numeric value";
            }
        }
        if (!empty($product_discount_price)) {
            if (!is_numeric($product_discount_price)) {
                $errors[] = "Discount Price must be numeric value";
            }
        }
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $dataList = ProductModel::where('product_track_id', $product_track_id)->first();
            $dataList->product_category_id = $product_category_id;
            $dataList->product_title = $product_title;
            $dataList->product_sub_category_id = $product_sub_category_id;
            $dataList->product_price = $product_price;
            $dataList->product_description = $product_description;
            $dataList->product_brand_id = $product_brand_id;

            if ($product_mobile === 'Yes') {
                $dataList->product_mobile = Auth::user()->users_mobile;
            } else {
                $dataList->product_mobile = '';
            }
            if (!empty($product_discount_price)) {
                $dataList->product_discount_percentage = int(($product_discount_price * 100) / $product_price);
            }
            $dataList->product_discount = $product_discount;
            $dataList->product_discount_price = $product_discount_price;
            $dataList->product_negotiable = $product_negotiable;
            $dataList->product_country = $product_country;
            if ($dataList->save()) {
                return redirect('portal/product/userList')->with('success', 'Product successfully updated');
            }
        }
    }

}
