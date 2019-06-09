<?php

namespace App\Http\Controllers;

use App;
use App\Cart;
use App\Category;
use App\Order;
use App\Product;
use App\ProductTranslation;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $products = Product::orderBy('updated_at', 'desc')->paginate(4);
        $categories = Category::all();

        if (request()->category) {
            $category = Category::find(request()->category);
            $products = $category->products()->orderBy('updated_at', 'desc')->paginate(6);
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

    /* Cart:Add, Remove, Remove All */

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

    // Reduce By One Item From The Cart
    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('cart.index');
    }

    // Remove The Product From The Cart
    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('cart.index');
    }

    /* Checkout With Stripe */

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
            $charge = Charge::create([
                'amount' => $cart->totalPrice * 100,
                'currency' => 'usd',
                'description' => 'Test Charge',
                'source' => $token,
            ]);
            $order = new Order();
            $order->cart = serialize($cart);
            $order->name = $request->input('name');
            $order->address = $request->input('address');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
            
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Successfully Purrchased Products');
    }

    /* Wish List */

    public function getWishList()
    {
        if (!Session::has('wish')) {
            return view('wishlist.index');
        }

        $oldWish = Session::get('wish');
        $wish = new WishList($oldWish);

        return view('wishlist.index', [
            'products' => $wish->items
        ]);
    }

    public function addList(Request $request, $id)
    {
        $product = Product::find($id);

        $oldwish = Session::has('wish') ? Session::get('wish') : null;

        $wish = new WishList($oldwish);
        $wish->add($product, $product->id);

        $request->session()->put('wish', $wish);

        return redirect()->back()->withSuccess('Product Added Your Wish');
    }

    public function removeList($id)
    {
        $oldWish = Session::has('wish') ? Session::get('wish') : null;

        $wish = new WishList($oldWish);

        $wish->removeItem($id);
        if (count($wish->items) > 0) {
            Session::put('wish', $wish);
        } else {
            Session::forget('wish');
        }

        return redirect()->route('withlist.index');
    }
}
