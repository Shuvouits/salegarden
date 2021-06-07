<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\RandomNumberModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller {

    public function showList() {
        $dataList = User::where('users_track_id', '!=', Auth::user()->users_track_id)
                ->orderBy('created_at', 'DESC')
                ->get();
        return view('backend.pages.admin.list', compact('dataList'));
    }

    public function add() {
        return view('backend.pages.admin.add');
    }

    public function store(Request $request) {
        $users_track_id = Input::get('users_track_id');
        $users_name = Input::get('users_name');
        $users_username = Input::get('users_username');
        $users_email = Input::get('users_email');
        $users_mobile = Input::get('users_mobile');
        $users_type = Input::get('users_type');
        $users_status = Input::get('users_status');
        $password = Input::get('password');
        $re_password = Input::get('re_password');
        /*
         * Checking user moble number validation 
         */
        $number = ['011', '015', '016', '017', '018', '019'];
        $mobleNumber = str_split($users_mobile, 3);
        $mobleNumber[0];

        $errors = array();
        if (empty($users_name) || $users_name == '') {
            $errors[] = "Name cannot be empty";
        }

        if (empty($users_username) || $users_username == '') {
            $errors[] = "Username cannot be empty";
        }
        if (empty($users_mobile) || $users_mobile == '') {
            $errors[] = "Mobile no cannot be empty";
        }


        if (strlen($users_mobile) != 11) {
            $errors[] = "Mobile no must be greater than 11 character";
        }


        if (!is_numeric($users_mobile)) {
            $errors[] = "Mobile number must be numeric value";
        }
        $checkExistsPhone = User::where('users_mobile', Input::get('users_mobile'))
                ->exists();

        $checkExistsName = User::where('users_username', Input::get('users_username'))
                ->exists();

        if (!empty(Input::get('users_email'))) {
            if (!filter_var(Input::get('users_email'), FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = "Email address not valid";
            } else {
                $checkExistsEmail = User::where('users_email', Input::get('users_email'))
                        ->exists();
                if ($checkExistsEmail) {
                    $errors[] = "Email exists already";
                }
            }
        }
        if ($checkExistsPhone) {
            return redirect()->back()->withInput()->with('error', 'Mobile No exists already');
        }
        if ($checkExistsName) {
            return redirect()->back()->withInput()->with('error', 'Username exists already');
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {

            /*
             * Store D.C information into database
             */
            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . "" . date('YmdHis');
            $obj = new User;
            $obj->users_name = $users_name;
            $obj->users_username = $users_username;
            $obj->users_email = $users_email;
            $obj->users_mobile = $users_mobile;
            $obj->created_at = Carbon::now();
            $obj->users_status = $users_status;
            $obj->users_type = $users_type;
            $obj->users_track_id = $trackId;
            $obj->password = bcrypt($password);
            $obj->created_at = Carbon::now();

            if ($obj->save()) {

                return redirect('portal/admin/list')->with('success', 'Admin added successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function showDetails($id) {
        $dataList = User::where('users_track_id', $id)->first();
        return view('backend.pages.admin.details', compact('dataList'));
    }

    public function activate($id) {
        $dataList = User::where('users_track_id', $id)->first();
        $dataList->users_status = "Active";

        if ($dataList->save()) {
            if ($objActivity->save()) {
                return redirect()->back()->with('success', 'Activated successfully');
            }
        }
    }

    public function inActivate(Request $request) {
        $id = $request['users_track_id'];
        $dataList = User::where('users_track_id', $id)->first();
        $dataList->users_status = "Inactive";
        $dataList->users_rejection_note = Input::get('users_rejection_note');
        if ($dataList->save()) {
            return redirect()->back()->with('success', 'Inactivated Successfully');
        }
    }

    public function reset($id) {
        $dataList = User::where('users_track_id', $id)->first();
        return view('backend.pages.admin.reset', compact('dataList'));
    }

    public function resetstore(Request $request) {
        $messages = [
            'password.required' => 'Password field is required',
            'password_confirmation.required' => 'Confirm Password field is required',
        ];

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
                ], $messages);

        $input = $request->only('password');
        $input['password'] = bcrypt($request->get('password'));
        $id = $request['users_track_id'];
        $dataList = User::where('users_track_id', $id)->first();
        $dataList->update($input);
        return redirect('portal/admin/list')->with('success', 'Admin User password has been updated');
    }


}
