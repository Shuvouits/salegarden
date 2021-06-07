<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\CategoryModel;
use App\SubCategoryModel;
use App\SecondCategoryModel;

class GeneralController extends Controller
{
    
    public function hellow()
    {
         return "hellow";
    }
    
    
    
    public function getSubCategory(Request $request) {
        //$product_category_id = $_POST['product_category_id'];
        $product_category_id = $request->input('product_category_id');

        $subCategoryList = SubCategoryModel::where('sub_category_category_id', $product_category_id)->get();
        $response = array('output' => 'success', 'msg' => 'data found', 'subCategoryList' => $subCategoryList);
        return response()->json($response);
    }

    public function getSub(Request $request) {
        $second_category_category_id = $_POST['second_category_category_id'];

        $subCategoryList = SubCategoryModel::where('sub_category_category_id', $second_category_category_id)->get();
        $response = array('output' => 'success', 'msg' => 'data found', 'subCategoryList' => $subCategoryList);
        return response()->json($response);
    }

    public function getSecondCategory(Request $request) {
        $product_sub_category_id = $_POST['product_sub_category_id'];

        $secondCategoryList = SecondCategoryModel::where('second_category_sub_id', $product_sub_category_id)->get();
        $response = array('output' => 'success', 'msg' => 'data found', 'secondCategoryList' => $secondCategoryList);
        return response()->json($response);
    }
}
