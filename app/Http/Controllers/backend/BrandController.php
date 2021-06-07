<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BrandModel;
use App\RandomNumberModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class BrandController extends Controller {

    public function showList() {
        $dataList = BrandModel::all();
        return view('backend.pages.brand.list', compact('dataList'));
    }

    public function add() {
        return view('backend.pages.brand.add');
    }

    public function store(Request $request) {

        $brand_name = Input::get('brand_name');
        $brand_status = Input::get('brand_status');

        $errors = array();

        if (empty($brand_name) || $brand_name == '') {
            $errors[] = "Name required";
        }

        if (empty($brand_status) || $brand_status == '') {
            $errors[] = "Status required";
        }

        if (BrandModel::where('brand_name', Input::get('brand_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $brand = New BrandModel();
            $brand->brand_name = $brand_name;
            $brand->brand_status = $brand_status;
            $brand->created_at = Carbon::now();
            $brand->brand_track_id = $trackId;
            if ($brand->save()) {
                return redirect('portal/brand/list')->with('success', 'Data successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function edit($id) {
        $dataList = BrandModel::where('brand_track_id', $id)->first();
        return view('backend.pages.brand.edit', compact('dataList'));
    }

    public function update(Request $request) {
        $brand_track_id = Input::get('brand_track_id');
        $brand_name = Input::get('brand_name');
        $brand_status = Input::get('brand_status');

        $errors = array();

        if (empty($brand_name) || $brand_name == '') {
            $errors[] = "Name required";
        }

        if (empty($brand_status) || $brand_status == '') {
            $errors[] = "Status required";
        }

        if (BrandModel::where('brand_track_id', '!=', $brand_track_id)
                        ->where('brand_name', Input::get('brand_name'))
                        ->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $brand = BrandModel::where('brand_track_id', $brand_track_id)->first();
            $brand->brand_name = $brand_name;
            $brand->brand_status = $brand_status;
            if ($brand->save()) {
                return redirect('portal/brand/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function delete(Request $request) {
        $id = Input::get('brand_track_id');
        BrandModel::where('brand_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Success :) information deleted.');
    }

}
