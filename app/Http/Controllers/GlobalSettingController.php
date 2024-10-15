<?php

namespace App\Http\Controllers;

use App\Models\Client\Contact;
use App\Models\Client\ContactDetails;
use App\Models\Client\CustomerSupport;
use App\Models\Client\Footer;
use App\Models\Client\FooterLinks;
use App\Models\Client\Navbar;
use App\Models\Client\Setting;
use App\Models\Client\SocialMediaList;
use Illuminate\Support\Facades\Cache;

class GlobalSettingController extends Controller
{
    public $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __construct()
    {
        $this->contactdetail = ContactDetails::first();
        $this->footer = Footer::first();
        $this->footer_links = FooterLinks::all();
        $this->header = Setting::first();
        $this->contacts = Contact::first();
        $this->cs = CustomerSupport::all();
        $this->sosmeds = SocialMediaList::all();
        $this->menus = Navbar::whereNull('parent')->with('children')->orderBy('index')->get();
    }
}
