<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\RandomNumberModel;
use App\CompanyInfoModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use Carbon\Carbon;
use Hash;

class ProfileController extends Controller {

    public function showProfileList() {

        $dataList = User::where('users_track_id', Auth::user()->users_track_id)
                ->first();
        if (Auth::user()->users_type === 'Company') {
            $companyInfo = CompanyInfoModel::where('company_info_users_id', Auth::user()->users_track_id)->first();
            return view('backend.pages.profile.companyIndex', compact('dataList', 'companyInfo'));
        } else if(Auth::user()->users_type === 'User' || Auth::user()->users_type === 'Super Admin' || Auth::user()->users_type === 'Admin'){

            return view('backend.pages.profile.index', compact('dataList'));
        } else {
            return redirect()->back();
        }
    }

    public function editProfileList() {
        $dataList = Auth::user();
        if (Auth::user()->users_type === 'Company') {
            $companyInfo = CompanyInfoModel::where('company_info_users_id', Auth::user()->users_track_id)->first();
            return view('backend.pages.profile.companyEdit', compact('dataList', 'companyInfo'));
        } else {
            return view('backend.pages.profile.edit', compact('dataList'));
        }
    }

    public function updateProfileList(Request $request) {
        $dataList = Auth::user();
        $users_name = Input::get('users_name');
        $users_username = Input::get('users_username');
        $users_email = Input::get('users_email');
        $users_mobile = Input::get('users_mobile');

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
        $checkExistsPhone = User::where('users_track_id', '!=', $dataList->users_track_id)
                ->where('users_mobile', Input::get('users_mobile'))
                ->exists();

        $checkExistsName = User::where('users_track_id', '!=', $dataList->users_track_id)
                ->where('users_username', Input::get('users_username'))
                ->exists();

        if (!empty(Input::get('users_email'))) {
            if (!filter_var(Input::get('users_email'), FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = "Email address not valid";
            } else {
                $checkExistsEmail = User::where('users_track_id', '!=', $dataList->users_track_id)
                        ->where('users_email', Input::get('users_email'))
                        ->exists();
                if ($checkExistsEmail) {
                    $errors[] = "Email exists already";
                }
            }
        }
        if ($checkExistsPhone) {
            $errors[] = "Mobile No exists already";
        }
        if ($checkExistsName) {
            $errors[] = "Username exists already";
        }
        if ($_FILES['users_image']['name']) {

            $allowed = array('jpeg', 'png', 'jpg', 'gif');
            $ext = pathinfo($_FILES['users_image']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $errors[] = "Only JPG, JPEG, PNG image allowed";
            }
        }
        if (count($errors) > 0) {
            return redirect()->back()->withInput()
                            ->withErrors($errors)
                            ->with('errorArray', 'Array Error Occured ');
        } else {

            $image = $dataList->users_image;
            if (!empty($image)) {
                // check if image posted or not
                if ($_FILES['users_image']['name']) {

                    $allowed = array('jpeg', 'png', 'jpg', 'gif');
                    $ext = pathinfo($_FILES['users_image']['name'], PATHINFO_EXTENSION);
                    $requestImage = $request->file('users_image');
                    $usersImage = public_path("upload/frontend/users_image/{$dataList->users_image}"); // get previous image from folder
                    if (File::exists($usersImage)) {
                        unlink($usersImage);
                    }
                    $imageName = date('YmdHis') . '.' . $request->users_image->getClientOriginalExtension();
                    $request->users_image->move(('upload/frontend/users_image'), $imageName);
                    $dataList->users_image = $imageName;
                } else {
                    $dataList->users_image = $dataList->users_image;
                }
            } else {
                if ($_FILES['users_image']['name']) {
                    $imageName = date('YmdHis') . '.' . $request->users_image->getClientOriginalExtension();
                    $request->users_image->move(('upload/frontend/users_image'), $imageName);
                    $dataList->users_image = $imageName;
                }
            }

            $dataList->users_name = $users_name;
            $dataList->users_email = $users_email;
            $dataList->users_username = $users_username;
            $dataList->users_mobile = $users_mobile;

            if ($dataList->save()) {
                return redirect('portal/profile')->with('success', 'Profile updated successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        }
    }

    public function companyUpdate(Request $request) {
        $dataList = Auth::user();
        $users_name = Input::get('users_name');
        $users_username = Input::get('users_username');
        $users_email = Input::get('users_email');
        $users_mobile = Input::get('users_mobile');

        $errors = array();


        if (empty($users_name) || $users_name == '') {
            $errors[] = "Company Name cannot be empty";
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
        $checkExistsPhone = User::where('users_track_id', '!=', $dataList->users_track_id)
                ->where('users_mobile', Input::get('users_mobile'))
                ->exists();

        $checkExistsName = User::where('users_track_id', '!=', $dataList->users_track_id)
                ->where('users_username', Input::get('users_username'))
                ->exists();

        if (!empty(Input::get('users_email'))) {
            if (!filter_var(Input::get('users_email'), FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = "Email address not valid";
            } else {
                $checkExistsEmail = User::where('users_track_id', '!=', $dataList->users_track_id)
                        ->where('users_email', Input::get('users_email'))
                        ->exists();
                if ($checkExistsEmail) {
                    $errors[] = "Email exists already";
                }
            }
        }
        if ($checkExistsPhone) {
            $errors[] = "Mobile No exists already";
        }
        if ($checkExistsName) {
            $errors[] = "Username exists already";
        }
        if ($_FILES['users_image']['name']) {

            $allowed = array('jpeg', 'png', 'jpg', 'gif');
            $ext = pathinfo($_FILES['users_image']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $errors[] = "Only JPG, JPEG, PNG image allowed";
            }
        }
        if ($_FILES['company_info_logo']['name']) {
            $allowed = array('jpeg', 'png', 'jpg', 'gif');
            $ext = pathinfo($_FILES['company_info_logo']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $errors[] = "Only JPG, JPEG, PNG image allowed";
            }
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()
                            ->withErrors($errors)
                            ->with('errorArray', 'Array Error Occured ');
        } else {

            $image = $dataList->users_image;
            if (!empty($image)) {
                // check if image posted or not
                if ($_FILES['users_image']['name']) {
                    $usersImage = public_path("upload/frontend/users_image/{$dataList->users_image}"); // get previous image from folder
                    if (File::exists($usersImage)) {
                        unlink($usersImage);
                    }
                    $imageName = date('YmdHis') . '.' . $request->users_image->getClientOriginalExtension();
                    $request->users_image->move(('upload/frontend/users_image'), $imageName);
                    $dataList->users_image = $imageName;
                } else {
                    $dataList->users_image = $dataList->users_image;
                }
            } else {
                if ($_FILES['users_image']['name']) {
                    $imageName = date('YmdHis') . '.' . $request->users_image->getClientOriginalExtension();
                    $request->users_image->move(('upload/frontend/users_image'), $imageName);
                    $dataList->users_image = $imageName;
                }
            }

            $dataList->users_name = $users_name;
            $dataList->users_email = $users_email;
            $dataList->users_username = $users_username;
            $dataList->users_mobile = $users_mobile;

            if ($dataList->save()) {

                $companyInfo = CompanyInfoModel::where('company_info_users_id', Auth::user()->users_track_id)->first();
                $companyInfo->company_info_website = Input::get('company_info_website');
                $companyInfo->company_info_phone = Input::get('company_info_phone');
                $companyInfo->company_info_contact_person = Input::get('company_info_contact_person');
                $companyInfo->company_info_contact_person_mobile = Input::get('company_info_contact_person_mobile');
                $companyInfo->company_info_contact_person_position = Input::get('company_info_contact_person_position');
                $companyInfo->company_info_contact_person_email = Input::get('company_info_contact_person_email');
                $companyInfo->company_info_description = Input::get('company_info_description');

                $image = $companyInfo->company_info_logo;
                if (!empty($image)) {
                    // check if image posted or not
                    if ($_FILES['company_info_logo']['name']) {
                        $usersImage = public_path("upload/frontend/company_info_logo/{$companyInfo->company_info_logo}"); // get previous image from folder
                        if (File::exists($usersImage)) {
                            unlink($usersImage);
                        }
                        $imageName = date('YmdHis') . '.' . $request->company_info_logo->getClientOriginalExtension();
                        $request->company_info_logo->move(('upload/frontend/company_info_logo'), $imageName);
                        $companyInfo->company_info_logo = $imageName;
                    } else {
                        $companyInfo->company_info_logo = $companyInfo->company_info_logo;
                    }
                } else {
                    if ($_FILES['company_info_logo']['name']) {
                        $imageName = date('YmdHis') . '.' . $request->company_info_logo->getClientOriginalExtension();
                        $request->company_info_logo->move(('upload/frontend/company_info_logo'), $imageName);
                        $companyInfo->company_info_logo = $imageName;
                    }
                }

                if ($companyInfo->save()) {
                    return redirect('portal/profile')->with('success', 'Profile updated successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        }
    }

    public function editPassword() {
        $dataList = Auth::user();
        return view('backend.pages.profile.password', compact('dataList'));
    }

    public function updatePassword(Request $request) {
        $dataList = Auth::user();

        $old_password = Input::get('old_password');
        $password = Input::get('password');
        $re_password = Input::get('re_password');

        $errors = array();

        if (empty($old_password) || $old_password == '') {
            $errors[] = "Old password cannot be empty";
        }

        if (empty($password) || $password == '') {
            $errors[] = "New password cannot be empty";
        }

        if (empty($re_password) || $re_password == '') {
            $errors[] = "Retype password cannot be empty";
        }

        if ($password != $re_password) {
            $errors[] = "Password not matched";
        }

        if (strlen($password) < 6) {
            $errors[] = "Password length must be greater than 6 character";
        }

        if (strlen($password) > 15) {
            $errors[] = "Password length must be less than 15 character";
        }
        if (count($errors) > 0) {
            return redirect()->back()->withInput()
                            ->withErrors($errors)
                            ->with('errorArray', 'Array Error Occured ');
        } else {
            if (Hash::check($request->get('old_password'), $dataList->password)) {
                if (Hash::check($request->get('password'), $dataList->password)) {
                    return redirect()->back()->with('error', 'Sorry. This password is used before.');
                } else {

                    $dataList->password = bcrypt($password);

                    if ($dataList->save()) {
                        return redirect('portal/profile')->with('success', 'Password changed successfully');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong.');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Old password not matched');
            }
        }
    }

}
