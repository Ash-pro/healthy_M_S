<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function about()
    {
        return view('website.aboutUs');
    }
    public function contact()
    {
        return view('website.contactUS');
    }
    public function contact_store(Request $request)
    {

        $contactUs = ContactUs::create($request->all());
        return view('website.thanks');
    }
}
