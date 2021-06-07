<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderModel;
use App\OrderDetailModel;
use App\RandomNumberModel;
use App\ProductModel;
use App\AreaModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;

class OrderController extends Controller {

    public function order($id) {

        $product = ProductModel::where('product_track_id', $id)->first();

        $order = OrderModel::where('order_ip', $_SERVER['REMOTE_ADDR'])->whereDay('created_at', Carbon::now()->day)->where('order_status', 'Process')->first();
        if (!empty($order)) {
            $trackId = $order->order_track_id;
            if (Auth::user()) {
                $order->order_users_id = Auth::user()->users_track_id;
            }
        } else {
            $randomNumber = new RandomNumberModel;

            $trackId = $randomNumber->randomNumber(5, 10) . "JA" . date('YmdHis');
            $order = new OrderModel;
            $order->order_ip = $_SERVER['REMOTE_ADDR'];
            $order->order_track_id = $trackId;
            if (Auth::user()) {
                $order->order_users_id = Auth::user()->users_track_id;
            }
            $order->order_status = "Process";
            $order->order_payment = "Not Complete";
            $order->created_at = Carbon::now();
            $order = new OrderModel;
            $order->order_ip = $_SERVER['REMOTE_ADDR'];
            $order->order_track_id = $trackId;
            if (Auth::user()) {
                $order->order_users_id = Auth::user()->users_track_id;
            }
            $order->order_status = "Process";
            $order->order_payment = "Not Complete";
            $order->created_at = Carbon::now();
        }

        if ($order->save()) {
            $orderDetail = new OrderDetailModel;
            $orderDetail->order_id = $trackId;
            $orderDetail->product_id = $id;
            $orderDetail->quantity = 1;
            $orderDetail->amount = $product->product_price;
            $orderDetail->created_at = Carbon::now();

            if ($orderDetail->save()) {
                return redirect()->back()->with('success', 'Product added successfully');
            }
        }
    }

    public function checkout() {
        $order = OrderModel::where('order_ip', $_SERVER['REMOTE_ADDR'])->whereDay('created_at', Carbon::now()->day)->where('order_status', 'Process')->first();
        return view('frontend.pages.checkout', compact('order'));
    }

    public function checkoutStore(Request $request) {
        $id = $request->id;
        $quantity = $request->quantity;


        $orderDetail = OrderDetailModel::where('id', $id)->first();

        $product = ProductModel::where('product_track_id', $orderDetail->product_id)->first();

        $price = $product->product_price * $quantity;
        $orderDetail->quantity = $quantity;
        $orderDetail->amount = $price;
        if ($orderDetail->save()) {
            return redirect()->back()->with('success', 'Quantity added successfully');
        }
    }

    public function destroy(Request $request) {
        $id = $request->order_detail_id;

        OrderDetailModel::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function orderDetails($id) {
        $areas = AreaModel::where('area_status', 'Active')->get();
        return view('frontend.pages.orderDetails', compact('id', 'areas'));
    }

    public function orderDetailsStore(Request $request) {
        $order_name = Input::get('order_name');
        $order_mobile = Input::get('order_mobile');
        $order_area = Input::get('order_area');
        $order_address = Input::get('order_address');
        $order_payment_type = Input::get('order_payment_type');

        $order_track_id = Input::get('order_track_id');


        $errors = array();

        if (empty($order_name) || $order_name == '') {
            $errors[] = "Full Name required";
        }

        if (empty($order_mobile) || $order_mobile == '') {
            $errors[] = "Mobile No required";
        }

        if (!empty($order_mobile)) {

            $number = ['011', '015', '016', '017', '018', '019'];
            $mobileNumber = str_split($order_mobile, 3);
            $mobileNumber[0];


            if (strlen($order_mobile) != 11) {
                $errors[] = "Mobile No must be 11 digit";
            }
            if (!is_numeric($order_mobile)) {
                $errors[] = "Mobile no must be numeric value";
            }

            if (!in_array($mobileNumber[0], $number)) {
                $errors[] = "Mobile no is not valid";
            }
        }

        if (empty($order_area) || $order_area == '') {
            $errors[] = "Area  required";
        }        

        if (empty($order_address) || $order_address == '') {
            $errors[] = "Address required";
        }

if (empty($order_payment_type) || $order_payment_type == '') {
            $errors[] = "Payment Type required";
        }
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {

            $dataList = OrderModel::where('order_track_id', $order_track_id)->first();
            $dataList->order_name = $order_name;
            $dataList->order_mobile = $order_mobile;
            $dataList->order_area = $order_area;
            $dataList->order_address = $order_address;
            $dataList->order_payment_type = $order_payment_type;
            $dataList->save();
            return redirect('orderFinal/' . $order_track_id)->with('success', 'Your order completed successfully');
    }
}

public function orderFinal($id) {
    $order = OrderModel::where('order_track_id', $id)->first();
    return view('frontend.pages.orderFinal', compact('order'));
}

public function orderConfirm($id) {
    $order = OrderModel::where('order_track_id', $id)->first();

            $order->order_status = 'Complete';
            $order->save();

    return view('frontend.pages.orderConfirm', compact('order'));
}

}
