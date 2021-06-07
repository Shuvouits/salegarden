<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;
use App\ReviewModel;
use App\RandomNumberModel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function getReview($id) {
    	$dataList = ProductModel::where('product_track_id', $id)->first();
        return view('frontend.pages.review', compact('dataList'));
    }

    public function postReview(Request $request) {
        $review_details = Input::get('review_details');
        $review_star = Input::get('review_star');
        $review_product_id = Input::get('review_product_id');


        $errors = array();

        if (empty($review_details) || $review_details == '') {
            $errors[] = "Details required";
        }

        if (empty($review_star) || $review_star == '') {
            $errors[] = "Rating required";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {

            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "OL" . date('YmdHis');
            $dataList = new ReviewModel;
            $dataList->review_details = $review_details;
            $dataList->review_star = $review_star;
            $dataList->review_product_id = $review_product_id;
            $dataList->review_track_id = $trackId;
            $dataList->review_status = 'Active';
            $dataList->created_at = Carbon::now();

            if ($dataList->save()) {
                $productList = ProductModel::where('product_track_id', $review_product_id)->first();
                if(!empty($productList)) {
                    $review = ReviewModel::where('review_product_id', $review_product_id)->avg('review_star');
                    $productList->product_review = $review;
                    $productList->save();
                }
                
                return redirect('productDetails/' . $review_product_id)->with('success', 'Your Review added successfully');
            } else {
                return redirect()->back()->with('error', 'Please try again later.');
            }
        }
    }
}
