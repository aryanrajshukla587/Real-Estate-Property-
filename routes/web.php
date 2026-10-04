<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| FRONTEND CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController as FrontPropertyController;


/*
|--------------------------------------------------------------------------
| AUTH CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| USER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\PropertyTransactionController;
use App\Http\Controllers\User\ProfileController;


/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\NewsletterSubscriberController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PropertyTransactionController as AdminPropertyTransactionController;


/*
|--------------------------------------------------------------------------
| AGENT CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\Agent\PropertyTransactionController as AgentPropertyTransactionController;


/*
|--------------------------------------------------------------------------
| OWNER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Owner\OwnerPropertyController;
use App\Http\Controllers\Owner\OwnerPropertyTransactionController;


/*
|--------------------------------------------------------------------------
| OTHER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;


/*
|--------------------------------------------------------------------------
| PUBLIC / FRONTEND ROUTES
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| ABOUT
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {

    return view('pages.about');

})->name('about');


/*
|--------------------------------------------------------------------------
| PROPERTY LISTING
|--------------------------------------------------------------------------
*/

Route::get('/property', [FrontPropertyController::class, 'index'])
    ->name('property');


/*
|--------------------------------------------------------------------------
| PROPERTY DETAILS
|--------------------------------------------------------------------------
*/

Route::get(
    '/property-details/{slug}',
    [FrontPropertyController::class, 'show']
)->name('property.details');


/*
|--------------------------------------------------------------------------
| GALLERY
|--------------------------------------------------------------------------
*/

Route::get('/gallery', function () {

    return view('pages.gallery');

})->name('gallery');


/*
|--------------------------------------------------------------------------
| AGENT PROFILE
|--------------------------------------------------------------------------
*/

Route::get('/agent-profile/{id}', function ($id) {

    return view('pages.agent-profile', compact('id'));

})->name('agent.profile');


/*
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
*/

Route::get('/faq', function () {

    return view('pages.faq');

})->name('faq');


/*
|--------------------------------------------------------------------------
| BLOG
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {

    return view('pages.blog');

})->name('blog');


/*
|--------------------------------------------------------------------------
| BLOG POST
|--------------------------------------------------------------------------
*/

Route::get('/blog/{slug}', function ($slug) {

    return view('pages.blog-post', compact('slug'));

})->name('blog.post');


/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');


/*
|--------------------------------------------------------------------------
| NEWSLETTER
|--------------------------------------------------------------------------
*/

Route::post(
    '/newsletter/subscribe',
    [NewsletterController::class, 'store']
)->name('newsletter.subscribe');


/*
|--------------------------------------------------------------------------
| USER / AGENT / OWNER AUTHENTICATION
|--------------------------------------------------------------------------
|
| /login se:
|
| role = agent → agent middleware → Agent Dashboard
| role = owner → web guard     → Owner Dashboard
| role = user  → web guard     → User Dashboard
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| LOGIN PAGE
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [LoginController::class, 'showLoginForm']
)->name('login');


/*
|--------------------------------------------------------------------------
| LOGIN SUBMIT
|--------------------------------------------------------------------------
*/

Route::post(
    '/login',
    [LoginController::class, 'login']
)->name('login.store');


/*
|--------------------------------------------------------------------------
| AGENT LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| USER / OWNER LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/user/logout',
    [LoginController::class, 'userLogout']
)->name('user.logout');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [RegisterController::class, 'showRegistrationForm']
)->name('register');

Route::post(
    '/register',
    [RegisterController::class, 'register']
)->name('register.store');


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
|
| Normal logged-in users only.
|
| User:
| - Dashboard
| - Buy Property
| - Rent Property
| - Submit Property Request
| - View Transactions
| - Edit Pending Transaction
| - Update Offer
| - Cancel Transaction
| - Complete Deal
| - Profile
|
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/user/dashboard',
        [UserDashboardController::class, 'index']
    )->name('user.dashboard');


    /*
    |--------------------------------------------------------------------------
    | USER PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/user/profile',
        [ProfileController::class, 'edit']
    )->name('user.profile.edit');

    Route::put(
        '/user/profile',
        [ProfileController::class, 'update']
    )->name('user.profile.update');


    /*
    |--------------------------------------------------------------------------
    | BUY PROPERTY
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/property/{property}/buy',
        [PropertyTransactionController::class, 'buy']
    )->name('property.buy');


    /*
    |--------------------------------------------------------------------------
    | RENT PROPERTY
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/property/{property}/rent',
        [PropertyTransactionController::class, 'rent']
    )->name('property.rent');


    /*
    |--------------------------------------------------------------------------
    | STORE PROPERTY TRANSACTION
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/property/{property}/transaction',
        [PropertyTransactionController::class, 'store']
    )->name('property.transaction.store');


    /*
    |--------------------------------------------------------------------------
    | USER TRANSACTION DETAILS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/user/transactions/{transaction}',
        [PropertyTransactionController::class, 'show']
    )->name('user.transaction.show');


    /*
    |--------------------------------------------------------------------------
    | EDIT USER TRANSACTION / OFFER
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/user/transactions/{transaction}/edit',
        [PropertyTransactionController::class, 'edit']
    )->name('user.transaction.edit');


    /*
    |--------------------------------------------------------------------------
    | UPDATE USER OFFER
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/user/transactions/{transaction}',
        [PropertyTransactionController::class, 'update']
    )->name('user.transaction.update');


    /*
    |--------------------------------------------------------------------------
    | CANCEL USER TRANSACTION
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/user/transactions/{transaction}/cancel',
        [PropertyTransactionController::class, 'cancel']
    )->name('user.transaction.cancel');


    /*
    |--------------------------------------------------------------------------
    | DEAL DONE / COMPLETE TRANSACTION
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/user/transactions/{transaction}/complete',
        [PropertyTransactionController::class, 'complete']
    )->name('user.transaction.complete');

});


/*
|--------------------------------------------------------------------------
| OWNER ROUTES
|--------------------------------------------------------------------------
|
| Owner:
|
| - Dashboard
| - My Properties
| - Add Property
| - Store Property
| - Property Details
| - Edit Property
| - Update Property
| - Delete Property
| - Pending Properties
| - Active Properties
| - Rejected Properties
| - Property Requests
| - Request Details
| - Counter Offer
| - Request Status Update
|
|--------------------------------------------------------------------------
*/

Route::prefix('owner')
    ->name('owner.')
    ->middleware(['auth', 'owner'])
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | OWNER DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [OwnerDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PENDING PROPERTIES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/pending',
            [OwnerPropertyController::class, 'pending']
        )->name('properties.pending');


        /*
        |--------------------------------------------------------------------------
        | ACTIVE PROPERTIES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/active',
            [OwnerPropertyController::class, 'active']
        )->name('properties.active');


        /*
        |--------------------------------------------------------------------------
        | REJECTED PROPERTIES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/rejected',
            [OwnerPropertyController::class, 'rejected']
        )->name('properties.rejected');


        /*
        |--------------------------------------------------------------------------
        | MY PROPERTIES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties',
            [OwnerPropertyController::class, 'index']
        )->name('properties.index');


        /*
        |--------------------------------------------------------------------------
        | ADD PROPERTY
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/create',
            [OwnerPropertyController::class, 'create']
        )->name('properties.create');


        /*
        |--------------------------------------------------------------------------
        | STORE PROPERTY
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/properties',
            [OwnerPropertyController::class, 'store']
        )->name('properties.store');


        /*
        |--------------------------------------------------------------------------
        | PROPERTY DETAILS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/{property}',
            [OwnerPropertyController::class, 'show']
        )->name('properties.show');


        /*
        |--------------------------------------------------------------------------
        | EDIT PROPERTY
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/properties/{property}/edit',
            [OwnerPropertyController::class, 'edit']
        )->name('properties.edit');


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROPERTY
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/properties/{property}',
            [OwnerPropertyController::class, 'update']
        )->name('properties.update');


        /*
        |--------------------------------------------------------------------------
        | DELETE PROPERTY
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/properties/{property}',
            [OwnerPropertyController::class, 'destroy']
        )->name('properties.destroy');


        /*
        |--------------------------------------------------------------------------
        | OWNER PROPERTY TRANSACTIONS
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | PROPERTY REQUESTS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/property-transactions',
            [OwnerPropertyTransactionController::class, 'index']
        )->name('property-transactions.index');


        /*
        |--------------------------------------------------------------------------
        | PROPERTY REQUEST DETAILS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/property-transactions/{transaction}',
            [OwnerPropertyTransactionController::class, 'show']
        )->name('property-transactions.show');


        /*
        |--------------------------------------------------------------------------
        | COUNTER OFFER
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/property-transactions/{transaction}/counter-offer',
            [OwnerPropertyTransactionController::class, 'updateCounterOffer']
        )->name('property-transactions.counter-offer');


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION STATUS UPDATE
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/property-transactions/{transaction}/status',
            [OwnerPropertyTransactionController::class, 'updateStatus']
        )->name('property-transactions.update-status');


        /*
        |--------------------------------------------------------------------------
        | AGENT ASSIGNMENT
        |--------------------------------------------------------------------------
        |
        | Future functionality.
        |
        | properties.user_id = Owner
        | properties.agent_id = Assigned Agent
        |
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | PROPERTY ENQUIRIES
        |--------------------------------------------------------------------------
        |
        | Dedicated property_enquiries table.
        |
        | PropertyTransaction ko enquiries ke liye reuse nahi karna.
        |
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | OWNER PROFILE
        |--------------------------------------------------------------------------
        |
        | Future functionality.
        |
        |--------------------------------------------------------------------------
        */

    });


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | ADMIN LOGIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/login',
            [AuthController::class, 'showLogin']
        )->name('login');


        /*
        |--------------------------------------------------------------------------
        | ADMIN LOGIN SUBMIT
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/login',
            [AuthController::class, 'login']
        )->name('login.submit');


        /*
        |--------------------------------------------------------------------------
        | ADMIN LOGOUT
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        )->name('logout');


        /*
        |--------------------------------------------------------------------------
        | PROTECTED ADMIN ROUTES
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin')->group(function () {


            /*
            |--------------------------------------------------------------------------
            | ADMIN DASHBOARD
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/dashboard',
                [DashboardController::class, 'index']
            )->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | APPROVE PROPERTY
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/properties/{property}/approve',
                [PropertyController::class, 'approve']
            )->name('properties.approve');


            /*
            |--------------------------------------------------------------------------
            | REJECT PROPERTY
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/properties/{property}/reject',
                [PropertyController::class, 'reject']
            )->name('properties.reject');


            /*
            |--------------------------------------------------------------------------
            | PROPERTY RESOURCE
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'properties',
                PropertyController::class
            );


            /*
            |--------------------------------------------------------------------------
            | PROPERTY TYPES
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'property-types',
                PropertyTypeController::class
            );


            /*
            |--------------------------------------------------------------------------
            | LOCATIONS
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'locations',
                LocationController::class
            );


            /*
            |--------------------------------------------------------------------------
            | AGENTS
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/agents',
                [AgentController::class, 'index']
            )->name('agents.index');


            /*
            |--------------------------------------------------------------------------
            | OWNERS
            |--------------------------------------------------------------------------
            |
            | Registered property owners.
            |
            | URL:
            | /admin/owners
            |
            | Route:
            | admin.owners.index
            |
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/owners',
                [OwnerController::class, 'index']
            )->name('owners.index');


            /*
            |--------------------------------------------------------------------------
            | NEWSLETTER SUBSCRIBERS
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'newsletter-subscribers',
                NewsletterSubscriberController::class
            )->only([
                'index',
                'update',
                'destroy',
            ]);


            /*
            |--------------------------------------------------------------------------
            | CONTACT MESSAGES
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'contact-messages',
                ContactMessageController::class
            )->only([
                'index',
                'update',
                'destroy',
            ]);


            /*
            |--------------------------------------------------------------------------
            | REPLY TO CONTACT MESSAGE
            |--------------------------------------------------------------------------
            */

            Route::post(
                'contact-messages/{contactMessage}/reply',
                [ContactMessageController::class, 'reply']
            )->name('contact-messages.reply');


            /*
            |--------------------------------------------------------------------------
            | ADMIN PROPERTY TRANSACTIONS
            |--------------------------------------------------------------------------
            */


            /*
            |--------------------------------------------------------------------------
            | PROPERTY REQUESTS
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/property-transactions',
                [AdminPropertyTransactionController::class, 'index']
            )->name('property-transactions.index');


            /*
            |--------------------------------------------------------------------------
            | PROPERTY TRANSACTION DETAILS
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/property-transactions/{transaction}',
                [AdminPropertyTransactionController::class, 'show']
            )->name('property-transactions.show');


            /*
            |--------------------------------------------------------------------------
            | PROPERTY TRANSACTION COUNTER OFFER
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/property-transactions/{transaction}/counter-offer',
                [AdminPropertyTransactionController::class, 'updateCounterOffer']
            )->name('property-transactions.counter-offer');


            /*
            |--------------------------------------------------------------------------
            | PROPERTY TRANSACTION STATUS UPDATE
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/property-transactions/{transaction}/status',
                [AdminPropertyTransactionController::class, 'updateStatus']
            )->name('property-transactions.update-status');

        });

    });


/*
|--------------------------------------------------------------------------
| AGENT ROUTES
|--------------------------------------------------------------------------
|
| Agent:
|
| /login
|     ↓
| LoginController
|     ↓
| role = agent
|     ↓
| agent guard / middleware
|     ↓
| /agent/dashboard
|
|--------------------------------------------------------------------------
*/

Route::prefix('agent')
    ->name('agent.')
    ->middleware('agent')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | AGENT DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AgentDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | AGENT PROPERTY MANAGEMENT
        |--------------------------------------------------------------------------
        |
        | Agent:
        | - Apni properties dekh sakta hai
        | - Property add kar sakta hai
        | - Property show kar sakta hai
        | - Apni property edit/update kar sakta hai
        |
        | Delete intentionally disabled.
        |
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'properties',
            AgentPropertyController::class
        )->only([
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AGENT TRANSACTION MANAGEMENT
        |--------------------------------------------------------------------------
        |
        | Agent:
        | - Assigned properties ki requests dekh sakta hai
        | - Request details dekh sakta hai
        | - Customer offer dekh sakta hai
        | - Counter offer set/update kar sakta hai
        | - Request status update kar sakta hai
        |
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | PROPERTY REQUESTS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/property-transactions',
            [AgentPropertyTransactionController::class, 'index']
        )->name('property-transactions.index');


        /*
        |--------------------------------------------------------------------------
        | PROPERTY REQUEST DETAILS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/property-transactions/{transaction}',
            [AgentPropertyTransactionController::class, 'show']
        )->name('property-transactions.show');


        /*
        |--------------------------------------------------------------------------
        | COUNTER OFFER
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/property-transactions/{transaction}/counter-offer',
            [AgentPropertyTransactionController::class, 'updateCounterOffer']
        )->name('property-transactions.counter-offer');


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION STATUS
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/property-transactions/{transaction}/status',
            [AgentPropertyTransactionController::class, 'updateStatus']
        )->name('property-transactions.update-status');

    });