<?php

namespace App\Http\Controllers;

use App;
use App\Cart;
use App\Category;
use App\Product;
use App\ProductTranslation;
use Illuminate\Http\Request;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        if (request()->category) {
            $category = Category::find(request()->category);
            $products = $category->products()->get();
        }
        
        return view('products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }


    // Change The Language
    public function lang($lang)
    {
        Session::put('lang', $lang);

        App::setLocale($lang);
        
        return redirect()->back()->with('success', 'Your Language Changed To '. __('home.language'));
    }

    // Add To Cart
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->back()->withSuccess('Product Added Your Cart');
    }

    // Cart Page
    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('cart.index');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('cart.index', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    // Checkout Page
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('cart.checkout', ['total' => $total]);
    }

    // Checkout Page
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('cart.index');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_iZlnQPa2iLsjDl0ctV8J3NHU');
        try {
            $token = $request->input('stripeToken');
            Charge::create([
                'amount' => $cart->totalPrice * 100,
                'currency' => 'usd',
                'description' => 'Test Charge',
                'source' => $token,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');

        return redirect()->route('product.index')->with('success', 'Successfully Purrchased Products');
    }
}
