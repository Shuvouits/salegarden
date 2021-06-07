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


class CompanyProductController extends Controller {

    public function showList() {
        $dataList = ProductModel::leftJoin('category', 'product.product_category_id', 'category.category_track_id')
                ->leftJoin('sub_category', 'product.product_sub_category_id', 'sub_category.sub_category_track_id')
                ->leftJoin('brand', 'product.product_brand_id', 'brand.brand_track_id')
                ->where('product_users_id', Auth::user()->users_track_id)
                ->where('product_division', 'Normal')
                ->select('product.*', 'category.category_name', 'sub_category.sub_category_name', 'brand.brand_name')
                ->orderBy('product.created_at', 'DESC')
                ->get();
        return view('backend.pages.company.list', compact('dataList'));
    }

    public function add() {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $subCategoryList = SubCategoryModel::all();
        $brandList = BrandModel::where('brand_status', 'Active')->get();
        return view('backend.pages.company.add', compact('categoryList', 'brandList', 'subCategoryList'));
    }

    public function store(Request $request) {
        $product_title = Input::get('product_title');
        $product_category_id = Input::get('product_category_id');
        $product_sub_category_id = Input::get('product_sub_category_id');
        $product_brand_id = Input::get('product_brand_id');
        $product_price = Input::get('product_price');
        $product_description = Input::get('product_description');

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
        if (empty($product_country) || $product_country == '') {
            $errors[] = "Product country required";
        }
        if (empty($product_price) || $product_price == '') {
            $errors[] = "Price required";
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
            $trackId = $randomNumber->randomNumber(5, 10) . date('YmdHis');
            $productNo = $randomNumber->mobileVerification(4, 6) . date('His');
            $dataList = new ProductModel;
            $dataList->product_users_id = Auth::user()->users_track_id;
            $dataList->product_category_id = $product_category_id;
            $dataList->product_title = $product_title;
            $dataList->product_sub_category_id = $product_sub_category_id;
            $dataList->product_status = 'Inactive';
            $dataList->product_track_id = $trackId;
            $dataList->product_brand_id = $product_brand_id;
            $dataList->product_price = $product_price;
            $dataList->product_description = $product_description;
            $dataList->product_division = 'Normal';
            $dataList->product_country = $product_country;
            $dataList->product_no = $productNo;
            $dataList->product_users_type = 'Company';

            if ($product_mobile === 'Yes') {
                $dataList->product_mobile = Auth::user()->users_mobile;
            } else {
                $dataList->product_mobile = '';
            }

            $dataList->product_discount = $product_discount;
            $dataList->product_discount_price = $product_discount_price;
            $dataList->product_negotiable = $product_negotiable;
            $dataList->created_at = Carbon::now();

            if ($dataList->save()) {

                if (!empty(Input::file("product_image_file"))) {
                    $img_name = $_FILES['product_image_file']['name'];
                    $i = 0;
                    if (count($_FILES['product_image_file']['name']) <= 20) {
                        foreach (Input::file("product_image_file") as $file) {

                            $image = $request->file('product_image_file')[$i];
                            $img = Image::make($image->getRealPath());
                            $imageName = $i . date('YmdHis') . rand(5, 10) . '.' . $request->product_image_file[$i]->getClientOriginalExtension();
                            $img->resize(261, 333)->save(('upload/frontend/product_image_file/') . $imageName);

                            $imageList = new ProductImageModel;
                            $imageList->product_image_file = $imageName;
                            $imageList->product_image_product_id = $trackId;
                            $imageList->created_at = Carbon::now();
                            $imageList->save();
                            $i++;
                        }
                    }
                }

                return redirect('portal/product/companyList')->with('success', 'Product successfully submitted');
            }
        }
    }

    public function edit($id) {
        $dataList = ProductModel::where('product_track_id', $id)->first();
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $subCategoryList = SubCategoryModel::where('sub_category_category_id', $dataList->product_category_id)
                        ->where('sub_category_status', 'Active')->get();
        $brandList = BrandModel::where('brand_status', 'Active')->get();
        return view('backend.pages.company.edit', compact('dataList', 'categoryList', 'subCategoryList', 'brandList'));
    }

    public function update(Request $request) {
        $product_track_id = Input::get('product_track_id');
        $product_title = Input::get('product_title');
        $product_category_id = Input::get('product_category_id');
        $product_sub_category_id = Input::get('product_sub_category_id');
        $product_brand_id = Input::get('product_brand_id');
        $product_price = Input::get('product_price');
        $product_description = Input::get('product_description');

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
            $errors[] = "Product country required";
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
            $dataList->product_brand_id = $product_brand_id;
            $dataList->product_price = $product_price;
            $dataList->product_country = $product_country;
            $dataList->product_description = $product_description;

            if ($product_mobile === 'Yes') {
                $dataList->product_mobile = Auth::user()->users_mobile;
            } else {
                $dataList->product_mobile = '';
            }

            $dataList->product_discount = $product_discount;
            $dataList->product_discount_price = $product_discount_price;
            $dataList->product_negotiable = $product_negotiable;
            if ($dataList->save()) {
                return redirect('portal/product/companyList')->with('success', 'Product successfully updated');
            }
        }
    }

    public function companyImage($id) {
        $dataList = ProductImageModel::where('product_image_product_id', $id)->get();
        return view('backend.pages.company.image', compact('dataList'))->with('product_image_product_id', $id);
    }

    public function addImage($id) {
        return view('backend.pages.company.addImage')->with('product_image_product_id', $id);
    }

    public function editImage($id) {
        $dataList = ProductImageModel::where('product_image_id', $id)->first();
        return view('backend.pages.company.editImage', compact('dataList'))->with('product_image_id', $id);
    }

    public function storeImage(Request $request) {
        $product_image_product_id = Input::get('product_image_product_id');
        $productImage = new ProductImageModel;

        if (count($request->file('product_image_file')) > 0) {

            if ($_FILES['product_image_file']['name']) {

                /*
                 * check file type
                 */
                $allowed = array('jpeg', 'png', 'jpg', 'JPG', 'PNG');
                $ext = pathinfo($_FILES['product_image_file']['name'], PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    return redirect()->back()->with('error', 'Only JPG, JPEG, PNG format allowed');
                } elseif (File::size(Input::file("product_image_file")) > 2048000) {
                    return redirect()->back()->with('error', 'Image Size must be less than 2 MB.');
                } else {
                    $image = $request->file('product_image_file');
                    $img = Image::make($image->getRealPath());
                    $imageName = date('YmdHis') . rand(5, 10) . '.' . $request->product_image_file->getClientOriginalExtension();
                    $img->resize(261, 333)->save(('upload/frontend/product_image_file/') . $imageName);

                    $productImage->product_image_file = $imageName;
                    $productImage->product_image_product_id = $product_image_product_id;
                    $productImage->created_at = Carbon::now();
                    if ($productImage->save()) {
                        return redirect('portal/product/image/' . $product_image_product_id)->with('success', 'Image saved');
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'Image required');
        }
    }

    public function updateImage(Request $request) {
        $product_image_id = Input::get('product_image_id');
        $productImage = ProductImageModel::where('product_image_id', $product_image_id)->first();

        if ($_FILES['product_image_file']['name']) {

            /*
             * check file type
             */
            $allowed = array('jpeg', 'png', 'jpg', 'JPG', 'PNG');
            $ext = pathinfo($_FILES['product_image_file']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                return redirect()->back()->with('error', 'Only JPG, JPEG, PNG format allowed');
            } elseif (File::size(Input::file("product_image_file")) > 2048000) {
                return redirect()->back()->with('error', 'Image Size must be less than 2 MB.');
            } else {
                $image = $request->file('product_image_file');
                $img = Image::make($image->getRealPath());
                $imageName = date('YmdHis') . rand(5, 10) . '.' . $request->product_image_file->getClientOriginalExtension();
                $img->resize(261, 333)->save(('upload/frontend/product_image_file/') . $imageName);
                $productImage->product_image_file = $imageName;
            }
        }
        if ($productImage->save()) {
            return redirect('portal/product/image/' . $productImage->product_image_product_id)->with('success', 'Image updated');
        }
    }

    public function deleteImage(Request $request) {
        $id = $request->input('product_image_id');
        $dataObj = ProductImageModel::findOrFail($id);
        $product_image_file = public_path("upload/frontend/product_image_file/{$dataObj->product_image_file}");

        if (File::exists($product_image_file)) {
            unlink($product_image_file);
        }
        ProductImageModel::destroy($id);
        return redirect()->back()->with('success', 'Success :) information deleted');
    }

}
