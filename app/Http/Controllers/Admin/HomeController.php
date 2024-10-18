<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\About;
use App\Models\Client\ActivitiesGallery;
use App\Models\Client\Activity;
use App\Models\Client\Blog;
use App\Models\Client\BlogPosts;
use App\Models\Client\Category;
use App\Models\Client\CertificationPage;
use App\Models\Client\ClientFeedback;
use App\Models\Client\Clients;
use App\Models\Client\Contact;
use App\Models\Client\ContactDetails;
use App\Models\Client\CustomerSupport;
use App\Models\Client\Footer;
use App\Models\Client\Hero;
use App\Models\Client\Portfolio;
use App\Models\Client\PortfolioClients;
use App\Models\Client\Service;
use App\Models\Client\ServiceItems;
use App\Models\Client\Setting;
use App\Models\Client\SocialMedia;
use App\Models\Client\Testimonials;
use App\Models\Client\Usp;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends GlobalSettingController
{
    function dashboard()
    {
        $this->blogpost_count = BlogPosts::count();
        $this->service_items_count = ServiceItems::count();
        $this->portfolio_count = Portfolio::count();
        $this->activities_gallery_count = ActivitiesGallery::count();
        return view('admin.dashboard', $this->data);
    }
    function index()
    {
        $this->hero = Hero::first();
        $this->usp = Usp::first();
        $this->social_media = SocialMedia::first();
        $this->testimonials = Testimonials::first();
        return view('admin.home', $this->data);
    }
    function services()
    {
        $this->services = Service::first();
        $this->serviceItems = ServiceItems::all();
        return view('admin.services', $this->data);
    }
    function about()
    {
        $this->about = About::first();
        // $this->serviceItems = ServiceItems::all();
        return view('admin.about', $this->data);
    }

    function clients()
    {
        $this->clients = Clients::all();
        $this->services = ServiceItems::all();
        $this->portfolioClientsPage = PortfolioClients::first();
        return view('admin.clients', $this->data);
    }
    function galleries()
    {
        $this->acitivityPage = Activity::first();
        $this->certificationPage = CertificationPage::first();
        return view('admin.galleries', $this->data);
    }
    function testimonials()
    {
        return view('admin.testimonials', $this->data);
    }
    function blog()
    {
        $this->blogPage = Blog::first();
        return view('admin.blog', $this->data);
    }
    function contact()
    {
        $this->contactDetail = ContactDetails::first();
        $this->contact = Contact::first();
        return view('admin.contact', $this->data);
    }
    function headerFooter()
    {
        $this->footer = Footer::first();
        return view('admin.header-footer', $this->data);
    }

    function setting()
    {
        $this->setting = Setting::first();
        return view('admin.setting', $this->data);
    }


    function tinymce(Request $request)
    {
        $originalName = $request->file('file')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('file')->storeAs('images/home', $imageName, 'public');
        return response()->json(['location' => "/storage/$image_url"]);
    }


    public function slugMaker(Request $request)
    {
        if ($request->db == 'serviceItems') {
            $this->slug =  SlugService::createSlug(ServiceItems::class, 'slug', $request->title);
        } elseif ($request->db == 'clientFeedback') {
            $this->slug =  SlugService::createSlug(ClientFeedback::class, 'slug', $request->title);
        } elseif ($request->db == 'blogPosts') {
            $this->slug =  SlugService::createSlug(BlogPosts::class, 'slug', $request->title);
        } elseif ($request->db == 'category') {
            $this->slug =  SlugService::createSlug(Category::class, 'slug', $request->title);
        }
        return response()->json(['slug' => $this->slug]);
    }

    public function getClients()
    {
        $this->clients = Clients::all();
        return response()->json($this->clients);
    }
    public function getFeedbackFormClient()
    {
        $this->clientFeedback = ClientFeedback::with('clients')->get();
        return response()->json($this->clientFeedback);
    }
    public function getCategory()
    {
        $this->category = Category::all();
        return response()->json($this->category);
    }
}
