<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderModel;
use App\OrderDetailModel;
use App\ProductModel;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

    public function showList() {

        $dataList = OrderDetailModel::where('id', '>', 0);

        $dataList->whereIn('order_id', function ($query) {
                $query->select('order_track_id')->from(with(New OrderModel)->getTable())->where('order_status', 'Complete');
            });

        $dataList->whereIn('product_id', function ($query) {
                $query->select('product_track_id')->from(with(New ProductModel)->getTable())->whereIn('product_users_id', Auth::user()->products);
            });

        $dataList = $dataList->orderBy('created_at', 'DESC')->paginate(50);

        return view('backend.pages.order.list', compact('dataList'));
    }

   

}
