<?php

namespace App\Http\Controllers;

use App\Models\Client\About;
use App\Models\Client\ActivitiesGallery;
use App\Models\Client\Activity;
use App\Models\Client\Blog;
use App\Models\Client\BlogPosts;
use App\Models\Client\Category;
use App\Models\Client\Certification;
use App\Models\Client\CertificationPage;
use App\Models\Client\ClientFeedback;
use App\Models\Client\Clients;
use App\Models\Client\Contact;
use App\Models\Client\ContactDetails;
use App\Models\Client\Hero;
use App\Models\Client\Portfolio;
use App\Models\Client\PortfolioClients;
use App\Models\Client\Projects;
use App\Models\Client\Service;
use App\Models\Client\ServiceItems;
use App\Models\Client\SocialMedia;
use App\Models\Client\SocialMediaList;
use App\Models\Client\Teams;
use App\Models\Client\TestimonialList;
use App\Models\Client\Testimonials;
use App\Models\Client\Usp;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use function Laravel\Prompts\error;

class HomeController extends GlobalSettingController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->hero = Hero::first();
        $this->service = Service::first();
        $this->servicesItems = ServiceItems::all();
        $this->about = About::first();
        $this->usp = Usp::first();
        $this->clients = Clients::all();
        $this->works = Portfolio::with('clients', 'service_items')->latest()->take(5)->get();
        $this->worksPage = PortfolioClients::first();
        $this->socials = SocialMediaList::all();
        $this->testimonials = TestimonialList::where('show', 1)->with('clients')->get();
        $this->posts = BlogPosts::with('category', 'author')->latest()->take(4)->get();
        $this->postsPage = Blog::first();
        $this->activities = ActivitiesGallery::latest()->take(10)->get();
        $this->activity = Activity::first();
        $this->projects = Projects::all();
        $this->social_media = SocialMedia::first();
        $this->testimonial = Testimonials::first();



        return view('home', $this->data);
    }


    public function about(Request $request)
    {
        $this->about = About::first();
        $this->teams = Teams::orderBy('index', 'asc')->get();
        return view('about', $this->data);
    }

    public function services(Request $request)
    {
        $this->services = Service::first();
        $this->serviceItems = ServiceItems::all();
        return view('services', $this->data);
    }
    public function servicesDetail(Request $request, $slug)
    {
        $this->serviceItems = ServiceItems::where('slug', $slug)->firstOrFail();
        $this->serviceItemsExcludeSlug = ServiceItems::where('slug', '!=', $slug)->get();
        return view('services-detail', $this->data);
    }

    public function certification(Request $request)
    {
        $this->certification = Certification::all();
        $this->certificationPage = CertificationPage::first();
        return view('certification', $this->data);
    }
    public function gallery(Request $request)
    {
        $this->gallery = Activity::first();
        $activities = ActivitiesGallery::latest()->paginate(10);
        $this->data['activities'] = $activities;
        if ($request->ajax()) {
            $view = view('components.card-activities', compact('activities'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $activities->nextPageUrl()]);
        }
        return view('gallery', $this->data);
    }


    public function blog(Request $request)
    {
        $this->blogPage = Blog::first();
        $query = BlogPosts::latest();
        $this->categories = Category::all();

        // If search query is present, filter the blog posts
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // If category filter is applied
        if ($request->has('category')) {
            $category = Category::where('slug', $request->get('category'))->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $this->posts = $query->paginate(12); // Paginate 10 posts per page

        return view('blog', $this->data);
    }

    public function blogDetail(Request $request, $slug)
    {
        $this->blog = BlogPosts::where('slug', $slug)->firstOrFail();
        $this->blogExclude = BlogPosts::where('slug', '!=', $slug)->limit(3)->get();
        return view('blog-detail', $this->data);
    }

    public function contact(Request $request)
    {
        $this->contact = ContactDetails::first();

        return view('contact', $this->data);
    }
    public function portfolio(Request $request)
    {
        $this->portfolio = Portfolio::all();
        $this->clients = Clients::all();
        $this->portfolioClientsPage = PortfolioClients::first();

        return view('client-portfolio', $this->data);
    }

    public function portfolioDetail($id)
    {
        // $portfolio = Portfolio::with(['clients, service_items'])->findOrFail($id);
        $portfolio = Portfolio::with(['clients', 'service_items', 'activities_gallery'])->findOrFail($id);
        $otherPortfolios = $portfolio->getOtherPortfolios($portfolio->id);

        return response()->json([
            'portfolio' => $portfolio,
            'other_portfolios' => $otherPortfolios,
        ]);
    }

    public function feedback(Request $request)
    {
        return view('feedback', $this->data);
    }
    public function feedbackGet(Request $request, $slug)
    {
        $this->form = ClientFeedback::where('slug', $slug)->with('clients')->firstOrFail();
        return view('feedback-client', $this->data);
    }
    public function feedbackPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'rating' => 'required|numeric',
            'position' => 'required',
        ]);

        $feedback = new TestimonialList();
        $feedback->name = $request->name;
        $feedback->desc = $request->message;
        $feedback->rating = $request->rating;
        $feedback->position = $request->position;
        if ($feedback->save()) {
            return back()->with('success', 'Thankyou! Your feedback was sent.');
        } else {
            return 'haduhh error';
        }
    }
    public function feedbackSlugPost(Request $request, $id)
    {
        $data = ClientFeedback::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'rating' => 'required|numeric',
            'position' => 'required',
        ]);

        $feedback = new TestimonialList();
        $feedback->client_feedback_id = $data->id;
        $feedback->name = $request->name;
        $feedback->desc = $request->message;
        $feedback->rating = $request->rating;
        $feedback->position = $request->position;
        if ($feedback->save()) {
            return back()->with('success', 'Thankyou ' . $request->name . '! Your feedback was sent.');
        } else {
            return back()->with('error', 'Gagal menyimpan testimony');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($home)
    {
        //
    }
}
