<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use App\ValueObjects\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('orders.index',[
            'orders' => Order::where('user_id', Auth::id())->paginate(10)
    ]);

    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(): RedirectResponse
    {
        $cart = Session::get('cart', new Cart());

        if($cart->hasItems()) {
            $order = new Order();
            $order->quantity = $cart->getQuantity();
            $order->price = $cart->getSum();
            $order->user_id = Auth::id();
            $order->save();
    
            $productsIds = $cart->getItems()->map(function($item) {
                return ['product_id' => $item->getProductId()];
    
            });
            $order->products()->attach($productsIds);
    
            Session::put('cart', new Cart());
            return redirect(route('orders.index'))->with('status', 'Zamówienie zrealizowane!');
        

        }

      return back();
      
    }

  
}
