<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactModel;

class ContactController extends Controller {
    public function showList() {

        $dataList = ContactModel::all();

        return view('backend.pages.contact.list', compact('dataList'));
    }

    public function delete(Request $request) {
        $id = $request->input('contact_id');
        ContactModel::where('contact_id', $id)->delete();
        return redirect()->back()->with('success', 'Successfully deleted');
    }

}
