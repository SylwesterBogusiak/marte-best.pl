<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\View\View;
use App\ValueObjects\Cart;
use Illuminate\Support\Arr;
use App\ValueObjects\CartItem;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{

    
    public function index(): View
    {

       // dd(Session::get('cart', new Cart()));

        return view('cart.index', [
            'cart' => Session::get('cart', new Cart())
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product): JsonResponse
    {


      
        $cart = Session::get('cart', new Cart());
        Session::put('cart',$cart->addItem($product));
        return response()->json([
            'status' => 'success'
        ]);
    }

 /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            
            $cart = Session::get('cart', new Cart());
            Session::put('cart',$cart->removeItem($product));
            Session::flash('status', __('shop.product.status.delete.success'));
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' =>'Wystąpil błąd!'
            ])->setStatusCode(500);
        }
        

        
    }
  



}
