<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContactModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class ContactController extends Controller {

    public function contact() {
        return view('frontend.pages.contact');
    }

    public function contactStore(Request $request) {
        $contact_name = Input::get('contact_name');
        $contact_email = Input::get('contact_email');
        $contact_phone = Input::get('contact_phone');
        $contact_subject = Input::get('contact_subject');
        $contact_message = Input::get('contact_message');

        $errors = array();
        /*
         * Checking contact name is empty or not
         */

        if (empty($contact_name) || $contact_name == '') {
            $errors[] = "Full name required";
        }

        /*
         * Checking contact phone is empty or not
         */
        if (empty($contact_phone) || $contact_phone == '') {
            $errors[] = "Phone No required";
        }
        /*
         * Checking contact phone number digit length 11 character or not
         */

        if (strlen($contact_phone) != 11) {
            $errors[] = "Phone No must be 11 character long";
        }
        /*
         * Checking phone number is numeric value or not
         */

        if (!is_numeric($contact_phone)) {
            $errors[] = "Phone No must be numeric value";
        }

        /*
         * Check password is empty or not
         */
        if (empty($contact_subject) || $contact_subject == '') {
            $errors[] = "Subject required";
        }
        /*
         * Check retype password is empty or not
         */
        if (empty($contact_message) || $contact_message == '') {
            $errors[] = "Message required";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
        } else {
            $obj = new ContactModel;
            $obj->contact_name = $contact_name;
            $obj->contact_email = $contact_email;
            $obj->contact_phone = $contact_phone;
            $obj->contact_subject = $contact_subject;
            $obj->contact_message = $contact_message;
            $obj->created_at = Carbon::now();
            if ($obj->save()) {
                return redirect()->back()->with('success', 'Thank you for contacting us. Hope you get your answers fast');
            } else {
                return redirect()->back()->with('error', 'Sorry !!! Something went wrong, please try again.');
            }
        }
    }

}
