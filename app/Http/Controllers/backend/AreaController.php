<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AreaModel;
use App\RandomNumberModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class AreaController extends Controller {

    public function showList() {
        $dataList = AreaModel::all();
        return view('backend.pages.area.list', compact('dataList'));
    }

    public function add() {
        return view('backend.pages.area.add');
    }

    public function store(Request $request) {

        $area_name = Input::get('area_name');
        $area_status = Input::get('area_status');

        $errors = array();

        if (empty($area_name) || $area_name == '') {
            $errors[] = "Name required";
        }

        if (empty($area_status) || $area_status == '') {
            $errors[] = "Status required";
        }

        if (AreaModel::where('area_name', Input::get('area_name'))->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $area = New AreaModel();
            $area->area_name = $area_name;
            $area->area_status = $area_status;
            $area->created_at = Carbon::now();
            $area->area_track_id = $trackId;
            if ($area->save()) {
                return redirect('portal/area/list')->with('success', 'Data successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function edit($id) {
        $dataList = AreaModel::where('area_track_id', $id)->first();
        return view('backend.pages.area.edit', compact('dataList'));
    }

    public function update(Request $request) {
        $area_track_id = Input::get('area_track_id');
        $area_name = Input::get('area_name');
        $area_status = Input::get('area_status');

        $errors = array();

        if (empty($area_name) || $area_name == '') {
            $errors[] = "Name required";
        }

        if (empty($area_status) || $area_status == '') {
            $errors[] = "Status required";
        }

        if (AreaModel::where('area_track_id', '!=', $area_track_id)
                        ->where('area_name', Input::get('area_name'))
                        ->exists()) {
            $errors[] = "Name already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $area = AreaModel::where('area_track_id', $area_track_id)->first();
            $area->area_name = $area_name;
            $area->area_status = $area_status;
            if ($area->save()) {
                return redirect('portal/area/list')->with('success', 'Data successfully updated');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function delete(Request $request) {
        $id = Input::get('area_track_id');
        AreaModel::where('area_track_id', $id)->delete();
        return redirect()->back()->with('success', 'Success :) information deleted.');
    }

}
