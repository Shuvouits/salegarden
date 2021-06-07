<?php

/*
 * This file contains the DistrictController which is under the namespace of backend.
 * 
 * @OCCS version 1.0
 * @php version 5.6
 * @laravel version 5.3
 * @author Olivine Limited (www.olivineltd.com)
 * @last-modified 30/1/17 
 */

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoryModel;
use App\SubCategoryModel;
use App\RandomNumberModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class SubCategoryController extends Controller {

    public function showList() {
        $dataList = SubCategoryModel::leftJoin('category', 'sub_category.sub_category_category_id', 'category.category_track_id')
                        ->orderBy('sub_category_id', 'DESC')
                        ->select('sub_category.*', 'category.category_name')->get();
        return view('backend.pages.subCategory.list', compact('dataList'));
    }

    public function add() {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        return view('backend.pages.subCategory.add', compact('categoryList'));
    }

    public function store(Request $request) {
        $sub_category_name = Input::get('sub_category_name');
        $sub_category_status = Input::get('sub_category_status');
        $sub_category_category_id = Input::get('sub_category_category_id');

        $errors = array();

        if (empty($sub_category_name) || $sub_category_name == '') {
            $errors[] = "Name required";
        }

        if (empty($sub_category_status) || $sub_category_status == '') {
            $errors[] = "Status required";
        }
        if (empty($sub_category_category_id) || $sub_category_category_id == '') {
            $errors[] = "Ctaegory name required";
        }

        if (SubCategoryModel::where('sub_category_category_id', Input::get('sub_category_category_id'))
                        ->where('sub_category_name', Input::get('sub_category_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $sub_category = New SubCategoryModel();
            $sub_category->sub_category_name = $sub_category_name;
            $sub_category->sub_category_status = $sub_category_status;
            $sub_category->sub_category_category_id = $sub_category_category_id;
            $sub_category->created_at = Carbon::now();
            $sub_category->sub_category_track_id = $trackId;
            if ($sub_category->save()) {
                return redirect('portal/subCategory/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function edit($id) {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $dataList = SubCategoryModel::where('sub_category_track_id', $id)->first();
        return view('backend.pages.subCategory.edit', compact('categoryList', 'dataList'));
    }

    public function update(Request $request) {
        $sub_category_name = Input::get('sub_category_name');
        $sub_category_status = Input::get('sub_category_status');
        $sub_category_category_id = Input::get('sub_category_category_id');
        $sub_category_track_id = Input::get('sub_category_track_id');

        $errors = array();

        if (empty($sub_category_name) || $sub_category_name == '') {
            $errors[] = "Name required";
        }

        if (empty($sub_category_status) || $sub_category_status == '') {
            $errors[] = "Status required";
        }
        if (empty($sub_category_category_id) || $sub_category_category_id == '') {
            $errors[] = "Category name required";
        }

        if (SubCategoryModel::where('sub_category_track_id', '!=', $sub_category_track_id)
                        ->where('sub_category_category_id', Input::get('sub_category_category_id'))
                        ->where('sub_category_name', Input::get('sub_category_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $sub_category = SubCategoryModel::where('sub_category_track_id', '!=', $sub_category_track_id)->first();
            $sub_category->sub_category_name = $sub_category_name;
            $sub_category->sub_category_status = $sub_category_status;
            $sub_category->sub_category_category_id = $sub_category_category_id;
            if ($sub_category->save()) {
                return redirect('portal/subCategory/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function delete(Request $request) {
        $id = Input::get('sub_category_track_id');
        SubCategoryModel::where('sub_category_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Success :) information deleted.');
    }

}
