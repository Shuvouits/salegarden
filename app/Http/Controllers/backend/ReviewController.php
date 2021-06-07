<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;
use App\ReviewModel;
use Illuminate\Support\Facades\Input;

class ReviewController extends Controller
{
    public function getReview($id) {
        $dataList = ReviewModel::where('review_product_id', $id)->get();
        $productList = ProductModel::where('product_track_id', $id)->first();
        return view('backend.pages.user.review', compact('dataList', 'productList'));
    }

    public function activate(Request $request) {
        $id = Input::get('review_track_id');
        $dataList = ReviewModel::where('review_track_id', $id)->first();
        $dataList->review_status = 'Active';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Review successfully activated');
        }
    }

    public function inactivate(Request $request) {
        $id = Input::get('review_track_id');
        $dataList = ReviewModel::where('review_track_id', $id)->first();
        $dataList->review_status = 'Inactive';
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Review successfully inactivated');
        }
    }
}
