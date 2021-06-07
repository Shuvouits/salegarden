<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoryModel;
use App\RandomNumberModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller {

    public function showList() {
        $dataList = CategoryModel::all();
        return view('backend.pages.category.list', compact('dataList'));
    }

    public function add() {
        return view('backend.pages.category.add');
    }

    public function store(Request $request) {

        $category_name = Input::get('category_name');
        $category_status = Input::get('category_status');

        $errors = array();

        if (empty($category_name) || $category_name == '') {
            $errors[] = "Name required";
        }

        if (empty($category_status) || $category_status == '') {
            $errors[] = "Status required";
        }

        if (CategoryModel::where('category_name', Input::get('category_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $category = New CategoryModel();
            $category->category_name = $category_name;
            $category->category_status = $category_status;
            $category->created_at = Carbon::now();
            $category->category_track_id = $trackId;
            if ($category->save()) {
                return redirect('portal/category/list')->with('success', 'Data successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function edit($id) {
        $dataList = CategoryModel::where('category_track_id', $id)->first();
        return view('backend.pages.category.edit', compact('dataList'));
    }

    public function update(Request $request) {
        $category_track_id = Input::get('category_track_id');
        $category_name = Input::get('category_name');
        $category_status = Input::get('category_status');

        $errors = array();

        if (empty($category_name) || $category_name == '') {
            $errors[] = "Name required";
        }

        if (empty($category_status) || $category_status == '') {
            $errors[] = "Status required";
        }

        if (CategoryModel::where('category_track_id', '!=', $category_track_id)
                        ->where('category_name', Input::get('category_name'))
                        ->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $category = CategoryModel::where('category_track_id', $category_track_id)->first();
            $category->category_name = $category_name;
            $category->category_status = $category_status;
            if ($category->save()) {
                return redirect('portal/category/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function delete(Request $request) {
        $id = Input::get('category_track_id');
        CategoryModel::where('category_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Success :) information deleted.');
    }

}
