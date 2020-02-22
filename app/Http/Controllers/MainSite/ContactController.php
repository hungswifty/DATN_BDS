<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function about()
    {
    	return view('mainsite.contact.aboutus');
    }
    public function contact()
    {
    	return view('mainsite.contact.contact');
    }
}
