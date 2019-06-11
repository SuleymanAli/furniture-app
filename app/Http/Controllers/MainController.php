<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // Show 8 Category On The Front Side
    public function index()
    {
        $categories = Category::take(8)->get();
        return view('home', ['categories' => $categories]);
    }

    // Product Url Address For SEO (Eg: title-one) 
    public function show($slug){
        // Fetch From The DB Based On Slug
        $productTranslation = ProductTranslation::where('slug', '=', $slug)->first();

        // Return The View And Pass In The Product Translation Object
        return view('products.show', ['productTranslation' => $productTranslation]);
    }

    // Show User Orders Your Profile Area On The Front Side 
    public function userProfile(){
    	$orders = Auth::user()->orders;
    	$orders->transform(function($order, $key){
    		$order->cart = unserialize($order->cart);

    		return $order;
    	});
    	return view('user.profile', ['orders' => $orders]);
    }

    // Contact Page (GET)
    public function getContact(){
        return view('page.contact');
    }

    // Contact Page (POST)
    public function postContact(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'subject'=>'min:3',
            'message'=>'min:10'
        ]);

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('suleymanali76@gmail.com');
            $message->subject($data['subject']);
        });

        Session::flash('success','Your Email Was Sent');

        return redirect('/');
    }
}
