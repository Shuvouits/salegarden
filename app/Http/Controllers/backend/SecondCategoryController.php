<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use App\SubCategoryModel;
use App\SecondCategoryModel;
use App\RandomNumberModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SecondCategoryController extends Controller {

    public function showList() {
        $dataList = SecondCategoryModel::leftJoin('category', 'second_category.second_category_category_id', 'category.category_track_id')
                        ->leftJoin('sub_category', 'second_category.second_category_sub_id', 'sub_category.sub_category_track_id')
                        ->orderBy('second_category_id', 'DESC')
                        ->select('second_category.*', 'category.category_name', 'sub_category.sub_category_name')->get();
        return view('backend.pages.secondCategory.list', compact('dataList'));
    }

    public function add() {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $subCategoryList = SubCategoryModel::where('sub_category_status', 'Active')->get();
        return view('backend.pages.secondCategory.add', compact('categoryList', 'subCategoryList'));
    }

    public function store(Request $request) {
        $second_category_name = Input::get('second_category_name');
        $second_category_status = Input::get('second_category_status');
        $second_category_category_id = Input::get('second_category_category_id');
        $second_category_sub_id = Input::get('second_category_sub_id');

        $errors = array();

        if (empty($second_category_name) || $second_category_name == '') {
            $errors[] = "Name required";
        }
        if (empty($second_category_sub_id) || $second_category_sub_id == '') {
            $errors[] = "Sub category required";
        }

        if (empty($second_category_status) || $second_category_status == '') {
            $errors[] = "Status required";
        }
        if (empty($second_category_category_id) || $second_category_category_id == '') {
            $errors[] = "Ctaegory name required";
        }

        if (SecondCategoryModel::where('second_category_category_id', Input::get('second_category_category_id'))
                        ->where('second_category_name', Input::get('second_category_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $second_category = New SecondCategoryModel();
            $second_category->second_category_name = $second_category_name;
            $second_category->second_category_status = $second_category_status;
            $second_category->second_category_category_id = $second_category_category_id;
            $second_category->second_category_sub_id = $second_category_sub_id;
            $second_category->created_at = Carbon::now();
            $second_category->second_category_track_id = $trackId;
            if ($second_category->save()) {
                return redirect('portal/secondCategory/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function edit($id) {
        $categoryList = CategoryModel::where('category_status', 'Active')->get();
        $subCategoryList = SubCategoryModel::where('sub_category_status', 'Active')->get();
        $dataList = SecondCategoryModel::where('second_category_track_id', $id)->first();
        return view('backend.pages.secondCategory.edit', compact('categoryList', 'dataList', 'subCategoryList'));
    }

    public function update(Request $request) {
        $second_category_name = Input::get('second_category_name');
        $second_category_status = Input::get('second_category_status');
        $second_category_sub_id = Input::get('second_category_sub_id');
        $second_category_category_id = Input::get('second_category_category_id');
        $second_category_track_id = Input::get('second_category_track_id');

        $errors = array();

        if (empty($second_category_name) || $second_category_name == '') {
            $errors[] = "Name required";
        }
        if (empty($second_category_sub_id) || $second_category_sub_id == '') {
            $errors[] = "Sub category required";
        }

        if (empty($second_category_status) || $second_category_status == '') {
            $errors[] = "Status required";
        }
        if (empty($second_category_category_id) || $second_category_category_id == '') {
            $errors[] = "Category name required";
        }

        if (SecondCategoryModel::where('second_category_track_id', '!=', $second_category_track_id)
                        ->where('second_category_category_id', Input::get('second_category_category_id'))
                        ->where('second_category_name', Input::get('second_category_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $second_category = SecondCategoryModel::where('second_category_track_id', $second_category_track_id)->first();
            $second_category->second_category_name = $second_category_name;
            $second_category->second_category_status = $second_category_status;
            $second_category->second_category_category_id = $second_category_category_id;
            $second_category->second_category_sub_id = $second_category_sub_id;
            if ($second_category->save()) {
                return redirect('portal/secondCategory/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function delete(Request $request) {
        $id = Input::get('second_category_track_id');
        SecondCategoryModel::where('second_category_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Success :) information deleted.');
    }

}
