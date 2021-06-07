<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\RandomNumberModel;
use App\CompanyInfoModel;
use App\ProductModel;

use Illuminate\Support\Facades\Auth;
use Socialite;

class RegisterController extends Controller {

    public function hellow()
    {
        $product = ProductModel::where('product_users_id', Auth::user()->users_track_id)->where('product_division', 'Normal')->count();
        return view('backend.pages.dashboard.user', compact('product'));
    }

    public function userRegister() {
        return view('frontend.pages.auth.userRegister');
    }

    public function companyRegister() {
        return view('frontend.pages.auth.companyRegister');
    }

    public function createUser(Request $request) {
        $users_name = Input::get('users_name');
        $users_username = Input::get('users_username');
        $users_email = Input::get('users_email');
        $users_mobile = Input::get('users_mobile');
        $password = Input::get('password');
        $re_password = Input::get('re_password');
        $users_type = Input::get('users_type');


        $errors = array();

        if (empty($users_name) || $users_name == '') {
            $errors[] = "Name required";
        }

        if (empty($users_username) || $users_username == '') {
            $errors[] = "Username required";
        }
        if (!empty($users_username)) {
            $checkExistsUsername = User::where('users_username', Input::get('users_username'))->exists();
            if ($checkExistsUsername) {
                $errors[] = "Username already exists";
            }
        }

        if (empty($users_mobile) || $users_mobile == '') {
            $errors[] = "Mobile No required";
        }

        if (!empty($users_mobile)) {

            $number = ['011', '015', '016', '017', '018', '019'];
            $mobileNumber = str_split($users_mobile, 3);
            $mobileNumber[0];


            if (strlen($users_mobile) != 11) {
                $errors[] = "Mobile No must be 11 digit";
            }
            if (!is_numeric($users_mobile)) {
                $errors[] = "Mobile no must be numeric value";
            }

            if (!in_array($mobileNumber[0], $number)) {
                $errors[] = "Mobile no is not valid";
            }

            $checkExists = User::where('users_mobile', Input::get('users_mobile'))->exists();
            if ($checkExists) {
                $errors[] = "Mobile no already exists";
            }
        }

        if (empty($users_type) || $users_type == '') {
            $errors[] = "User Type required";
        }
        if (empty($password) || $password == '') {
            $errors[] = "Password required";
        }

        if (empty($re_password) || $re_password == '') {
            $errors[] = "Re password required";
        }
        if (!empty($password)) {

            if ($password != $re_password) {
                $errors[] = "Password not matched";
            }


            if (strlen($password) < 6) {
                $errors[] = "Password Must be greater than 5 character";
            }

            if (strlen($password) > 15) {
                $errors[] = "Password must be greater than 6 character";
            }
        }

        if (!empty(Input::get('users_email'))) {
            if (!filter_var(Input::get('users_email'), FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = " Email is not valid";
            } else {
                $checkExistsEmail = User::where('users_email', Input::get('users_email'))->exists();
                if ($checkExistsEmail) {
                    $errors[] = "Email already exists";
                }
            }
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {

            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . date('YmdHis') . $randomNumber->randomNumber(5, 10);
            $obj = new User;
            $obj->users_name = $request->users_name;
            $obj->users_username = $request->users_username;
            $obj->users_email = $users_email;
            $obj->users_mobile = $request->users_mobile;
            $obj->password = bcrypt($request->password);
            $obj->created_at = Carbon::now();
            $obj->users_status = 'Active';
            $obj->users_type = $users_type;
            $obj->users_track_id = $trackId;

            if ($obj->save()) {
                if($users_type === 'Company') {
                $companyInfo = new CompanyInfoModel;

                $companyInfo->company_info_users_id = $trackId;

                $companyInfo->created_at = Carbon::now();
                $companyInfo->save();
            }

                return redirect('portal/login')->with('success', 'Your registration completed successfully');
            } else {
                return redirect()->back()->with('error', 'Please try again later.');
            }
        }
    }

    public function createCompany(Request $request) {
        $users_name = Input::get('users_name');
        $users_username = Input::get('users_username');
        $users_email = Input::get('users_email');
        $users_mobile = Input::get('users_mobile');
        $password = Input::get('password');
        $re_password = Input::get('re_password');


        $errors = array();

        if (empty($users_name) || $users_name == '') {
            $errors[] = "Company Name required";
        }

        if (empty($users_username) || $users_username == '') {
            $errors[] = "Username required";
        }

        if (empty($users_mobile) || $users_mobile == '') {
            $errors[] = "Mobile No required";
        }

        if (!empty($users_mobile)) {

            $number = ['011', '015', '016', '017', '018', '019'];
            $mobileNumber = str_split($users_mobile, 3);
            $mobileNumber[0];


            if (strlen($users_mobile) != 11) {
                $errors[] = "Mobile No must be 11 digit";
            }
            if (!is_numeric($users_mobile)) {
                $errors[] = "Mobile no must be numeric value";
            }

            if (!in_array($mobileNumber[0], $number)) {
                $errors[] = "Mobile no is not valid";
            }

            $checkExists = User::where('users_mobile', Input::get('users_mobile'))->exists();
            if ($checkExists) {
                $errors[] = "Mobile no already exists";
            }
        }

        if (empty($password) || $password == '') {
            $errors[] = "Password required";
        }

        if (empty($re_password) || $re_password == '') {
            $errors[] = "Re password required";
        }
        if (!empty($password)) {

            if ($password != $re_password) {
                $errors[] = "Password not matched";
            }


            if (strlen($password) < 6) {
                $errors[] = "Password Must be greater than 5 character";
            }

            if (strlen($password) > 15) {
                $errors[] = "Password must be greater than 6 character";
            }
        }

        if (!empty(Input::get('users_email'))) {
            if (!filter_var(Input::get('users_email'), FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = " Email is not valid";
            } else {
                $checkExistsEmail = User::where('users_email', Input::get('users_email'))->exists();
                if ($checkExistsEmail) {
                    $errors[] = "Email already exists";
                }
            }
        }

        $checkExistsUsername = User::where('users_username', Input::get('users_username'))->exists();
        if ($checkExistsUsername) {
            $errors[] = "Username already exists";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {

            $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . date('YmdHis');
            $obj = new User;
            $obj->users_name = $request->users_name;
            $obj->users_username = $request->users_username;
            $obj->users_email = $users_email;
            $obj->users_mobile = $request->users_mobile;
            $obj->password = bcrypt($request->password);
            $obj->created_at = Carbon::now();
            $obj->users_status = 'Active';
            $obj->users_type = 'Company';
            $obj->users_track_id = $trackId;

            if ($obj->save()) {

                $companyInfo = new CompanyInfoModel;

                $companyInfo->company_info_users_id = $trackId;

                $companyInfo->created_at = Carbon::now();
                if ($companyInfo->save()) {

                    return redirect('portal/login')->with('success', 'Your registration completed successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Please try again later.');
            }
        }
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $randomNumber = new RandomNumberModel;
            $trackId = $randomNumber->randomNumber(5, 10) . date('YmdHis') . $randomNumber->randomNumber(5, 10);

$authUser = User::where(['users_email' => $user->getEmail()])->first();
        if ($authUser) {

        Auth::login($authUser, true);
        } else {
            User::create([
            'users_name'     => $user->getName(),
            'users_email'    => $user->getEmail(),
            'users_status' => 'Active',
            'users_type' =>'Buyer',
            'provider' => $provider,
            'provider_id' => $trackId,
            'users_track_id' => $trackId
        ]);
            Auth::login($user, true);
        }

        return redirect('/');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'users_name'     => $user->name,
            'users_email'    => $user->email,
            'users_status' => 'Active',
            'users_type' =>'Buyer',
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

}
