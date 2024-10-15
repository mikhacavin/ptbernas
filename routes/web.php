<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\ActivitiesGalleryController;
use App\Http\Controllers\Client\ActivityController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\BlogPostsController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CertificationController;
use App\Http\Controllers\Client\CertificationPageController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientFeedbackController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\ContactDetailController;
use App\Http\Controllers\Client\CustomerSupportController;
use App\Http\Controllers\Client\FooterController;
use App\Http\Controllers\Client\FooterLinksController;
use App\Http\Controllers\Client\HeroController;
use App\Http\Controllers\Client\NavbarController;
use App\Http\Controllers\Client\PortfolioClientsController;
use App\Http\Controllers\Client\PortfolioController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\ServiceItemsController;
use App\Http\Controllers\Client\SettingController;
use App\Http\Controllers\Client\SocialMediaController;
use App\Http\Controllers\Client\SocialMediaListController;
use App\Http\Controllers\Client\TeamsController;
use App\Http\Controllers\Client\TestimonialController;
use App\Http\Controllers\Client\TestimonialListController;
use App\Http\Controllers\Client\UspController;
use App\Http\Controllers\HomeController;
use App\Models\Client\BlogPosts;
use App\Models\Client\CustomerSupport;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});


//admin
Route::prefix('dashboard')->middleware('auth')->group(function () {

    //home
    Route::controller(AdminHomeController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/home', 'index')->name('dashboard.home');
        Route::get('/services', 'services')->name('dashboard.services');
        Route::get('/about', 'about')->name('dashboard.about');
        Route::get('/clients', 'clients')->name('dashboard.clients');
        Route::get('/galleries', 'galleries')->name('dashboard.galleries');
        Route::get('/testimonials', 'testimonials')->name('dashboard.testimonials');
        Route::get('/blog', 'blog')->name('dashboard.blog');
        Route::get('/contact', 'contact')->name('dashboard.contact');
        Route::get('/header-footer', 'headerFooter')->name('dashboard.headerFooter');
        Route::get('/setting', 'setting')->name('dashboard.setting');

        //texteditor
        Route::post('/upload-image-tinymce', 'tinymce')->name('dashboard.tinymce');

        //slug
        Route::get('/slug/slugMaker', 'slugMaker')->name('slug.maker');

        //select2 json
        Route::get('/get-clients', 'getClients')->name('select2.getClients');
        Route::get('/get-feedback-form-client', 'getFeedbackFormClient')->name('select2.getClients');
        Route::get('/get-category', 'getCategory')->name('select2.getCategory');
    });

    //hero
    Route::controller(HeroController::class)->group(function () {
        Route::post('/hero', 'store')->name('hero.store');
        Route::put('/hero/{id}', 'update')->name('hero.update');
    });

    //service
    Route::controller(ServiceController::class)->group(function () {
        Route::post('/services', 'store')->name('services.store');
        Route::put('/services/{id}', 'update')->name('services.update');
    });

    //service items
    Route::controller(ServiceItemsController::class)->group(function () {
        Route::post('/serviceitems', 'store')->name('serviceitems.store');
        Route::get('/serviceitems/{id}', 'show')->name('serviceitems.show');
        Route::post('/edit-serviceitems/{id}', 'update')->name('serviceitems.update');
        Route::delete('/serviceitems/{id}', 'destroy')->name('serviceitems.destroy');
        Route::get('/datatable-serviceitems', 'queryDatatables')->name('serviceitems.datatable');
    });

    //about
    Route::controller(AboutController::class)->group(function () {
        Route::post('/about', 'store')->name('about.store');
        Route::put('/about/{id}', 'update')->name('about.update');
    });


    //teams
    Route::controller(TeamsController::class)->group(function () {
        Route::post('/teams', 'store')->name('teams.store');
        Route::get('/teams/{id}', 'show')->name('teams.show');
        Route::post('/edit-teams/{id}', 'update')->name('teams.update');
        Route::delete('/teams/{id}', 'destroy')->name('teams.destroy');
        Route::get('/datatable-teams', 'queryDatatables')->name('teams.datatable');
    });

    //usp
    Route::controller(UspController::class)->group(function () {
        Route::post('/usp', 'store')->name('usp.store');
        Route::put('/usp/{id}', 'update')->name('usp.update');
    });

    //client
    Route::controller(ClientController::class)->group(function () {
        Route::post('/client', 'store')->name('client.store');
        Route::get('/client/{id}', 'show')->name('client.show');
        Route::post('/edit-client/{id}', 'update')->name('client.update');
        Route::delete('/client/{id}', 'destroy')->name('client.destroy');
        Route::get('/datatable-client', 'queryDatatables')->name('client.datatable');
        Route::get('/get-clients-services', 'clientsServices')->name('clientsServices.collaboration');
    });

    //works
    Route::controller(PortfolioController::class)->group(function () {
        Route::post('/works', 'store')->name('works.store');
        Route::get('/works/{id}', 'show')->name('works.show');
        Route::post('/edit-works/{id}', 'update')->name('works.update');
        Route::delete('/works/{id}', 'destroy')->name('works.destroy');
        Route::get('/datatable-works', 'queryDatatables')->name('works.datatable');
    });

    //pportfolio clients page
    Route::controller(PortfolioClientsController::class)->group(function () {
        Route::put('/portfolioclients/{id}', 'update')->name('portfolioclients.update');
    });

    //galleries
    Route::controller(ActivitiesGalleryController::class)->group(function () {
        Route::post('/galleries', 'store')->name('galleries.store');
        Route::get('/galleries/{id}', 'show')->name('galleries.show');
        Route::post('/edit-galleries/{id}', 'update')->name('galleries.update');
        Route::delete('/galleries/{id}', 'destroy')->name('galleries.destroy');
        Route::get('/datatable-galleries', 'queryDatatables')->name('galleries.datatable');
        Route::get('/get-portfolio', 'getPortfolio')->name('galleries.getPortfolio');
    });

    //galleries page
    Route::controller(ActivityController::class)->group(function () {
        Route::put('/activity/{id}', 'update')->name('activity.update');
    });

    //socialmedialists
    Route::controller(SocialMediaListController::class)->group(function () {
        Route::post('/socialmedialist', 'store')->name('socialmedialist.store');
        Route::get('/socialmedialist/{id}', 'show')->name('socialmedialist.show');
        Route::post('/edit-socialmedialist/{id}', 'update')->name('socialmedialist.update');
        Route::delete('/socialmedialist/{id}', 'destroy')->name('socialmedialist.destroy');
        Route::get('/datatable-socialmedialist', 'queryDatatables')->name('socialmedialist.datatable');
    });

    //social media & projects section
    Route::controller(SocialMediaController::class)->group(function () {
        Route::put('/socialmedia/{id}', 'update')->name('socialmedia.update');
    });

    //client feedback
    Route::controller(ClientFeedbackController::class)->group(function () {
        Route::post('/clientfeedback', 'store')->name('clientfeedback.store');
        Route::get('/clientfeedback/{id}', 'show')->name('clientfeedback.show');
        Route::post('/edit-clientfeedback/{id}', 'update')->name('clientfeedback.update');
        Route::delete('/clientfeedback/{id}', 'destroy')->name('clientfeedback.destroy');
        Route::get('/datatable-clientfeedback', 'queryDatatables')->name('clientfeedback.datatable');
    });

    //feedback & testimonials data
    Route::controller(TestimonialListController::class)->group(function () {
        Route::post('/testimoniallist', 'store')->name('testimoniallist.store');
        Route::get('/testimoniallist/{id}', 'show')->name('testimoniallist.show');
        Route::post('/edit-testimoniallist/{id}', 'update')->name('testimoniallist.update');
        Route::delete('/testimoniallist/{id}', 'destroy')->name('testimoniallist.destroy');
        Route::get('/datatable-testimoniallist', 'queryDatatables')->name('testimoniallist.datatable');
    });

    //social media & projects section
    Route::controller(TestimonialController::class)->group(function () {
        Route::put('/testimonials/{id}', 'update')->name('testimonials.update');
    });

    //blog
    Route::controller(BlogPostsController::class)->group(function () {
        Route::post('/blog', 'store')->name('blog.store');
        Route::get('/blog/{id}', 'show')->name('blog.show');
        Route::post('/edit-blog/{id}', 'update')->name('blog.update');
        Route::delete('/blog/{id}', 'destroy')->name('blog.destroy');
        Route::get('/datatable-blog', 'queryDatatables')->name('blog.datatable');
    });

    //blog page
    Route::controller(BlogController::class)->group(function () {
        Route::put('/blogpage/{id}', 'update')->name('blogpage.update');
    });

    //category
    Route::controller(CategoryController::class)->group(function () {
        Route::post('/category', 'store')->name('category.store');
        Route::get('/category/{id}', 'show')->name('category.show');
        Route::post('/edit-category/{id}', 'update')->name('category.update');
        Route::delete('/category/{id}', 'destroy')->name('category.destroy');
        Route::get('/datatable-category', 'queryDatatables')->name('category.datatable');
    });

    //Contact
    Route::controller(ContactController::class)->group(function () {
        Route::put('/edit-contact/{id}', 'update')->name('contact.update');
    });
    Route::controller(ContactDetailController::class)->group(function () {
        Route::put('/edit-contact-page/{id}', 'update')->name('contactPage.update');
    });

    //footer
    Route::controller(FooterController::class)->group(function () {
        Route::put('/edit-footer/{id}', 'update')->name('footer.update');
    });
    //menu header
    Route::controller(NavbarController::class)->group(function () {
        Route::post('/menu', 'store')->name('menu.store');
        Route::get('/menu/{id}', 'show')->name('menu.show');
        Route::post('/edit-menu/{id}', 'update')->name('menu.update');
        Route::delete('/menu/{id}', 'destroy')->name('menu.destroy');
        Route::get('/datatable-menu', 'queryDatatables')->name('menu.datatable');
        Route::get('/get-menu', 'getNavbar')->name('menu.getMenu');
    });

    //footer links
    Route::controller(FooterLinksController::class)->group(function () {
        Route::post('/footer', 'store')->name('footer.store');
        Route::get('/footer/{id}', 'show')->name('footer.show');
        Route::post('/edit-footer/{id}', 'update')->name('footer.update');
        Route::delete('/footer/{id}', 'destroy')->name('footer.destroy');
        Route::get('/datatable-footer', 'queryDatatables')->name('footer.datatable');
    });

    //certification
    Route::controller(CertificationController::class)->group(function () {
        Route::post('/certification', 'store')->name('certification.store');
        Route::get('/certification/{id}', 'show')->name('certification.show');
        Route::post('/edit-certification/{id}', 'update')->name('certification.update');
        Route::delete('/certification/{id}', 'destroy')->name('certification.destroy');
        Route::get('/datatable-certification', 'queryDatatables')->name('certification.datatable');
    });

    //certification page
    Route::controller(CertificationPageController::class)->group(function () {
        Route::put('/cert/{id}', 'update')->name('cert.update');
    });


    //projects
    Route::controller(ProjectController::class)->group(function () {
        Route::post('/projects', 'store')->name('projects.store');
        Route::get('/projects/{id}', 'show')->name('projects.show');
        Route::post('/edit-projects/{id}', 'update')->name('projects.update');
        Route::delete('/projects/{id}', 'destroy')->name('projects.destroy');
        Route::get('/datatable-projects', 'queryDatatables')->name('projects.datatable');
    });

    //certification page
    Route::controller(SettingController::class)->group(function () {
        Route::put('/setting/{id}', 'update')->name('setting.update');
    });

    //cs
    Route::controller(CustomerSupportController::class)->group(function () {
        Route::post('/cs', 'store')->name('cs.store');
        Route::get('/cs/{id}', 'show')->name('cs.show');
        Route::post('/edit-cs/{id}', 'update')->name('cs.update');
        Route::delete('/cs/{id}', 'destroy')->name('cs.destroy');
        Route::get('/datatable-cs', 'queryDatatables')->name('cs.datatable');
    });
});







//client PAGE
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/service', 'services')->name('services');
    Route::get('/service/{slug}', 'servicesDetail')->name('servicesDetail');
    Route::get('/certification', 'certification')->name('certification');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'blogDetail')->name('blogDetail');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/portfolio', 'portfolio')->name('portfolio');
    Route::get('/portfolio/{id}', 'portfolioDetail')->name('portfolioDetail');
    Route::get('/feedback', 'feedback')->name('feedback');
    Route::get('/feedback/{slug}', 'feedbackGet')->name('feedbackGet');
    Route::post('/feedback', 'feedbackPost')->name('feedbackPost');
    Route::post('/feedback/{id}', 'feedbackSlugPost')->name('feedbackSlugPost');
});
