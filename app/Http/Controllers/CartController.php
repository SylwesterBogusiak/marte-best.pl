<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use App\Dtos\Cart\CartDto;
use Illuminate\Support\Arr;
use App\Dtos\Cart\CartItemDto;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {

        dd(Session::get('cart', new CartDto()));
        return view('home');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product): JsonResponse
    {


      
        $cart = Session::get('cart', new CartDto());
        $items = $cart->getItems();
        if (Arr::exists($items, $product->id))
        {
            $items[$product->id]->incrementQuantity();    
        }
        else
        {
            $cartItemDto = $this->getCartItemDto($product);
            $items[$product->id] = $cartItemDto;
        }


      

            $cart->setItems($items);
            $cart->incrementTotalQuantity();
            $cart->incrementTotalSum($product->price);

        Session::put('cart',$cart);
        return response()->json([
            'status' => 'success'
        ]);
    }



            /**
             * Get the value of cartItemDto
             */ 
public function getCartItemDto(Product $product)
    {

        $cartItemDto = new CartItemDto(); 
        $cartItemDto->setProductId($product->id);
        $cartItemDto->setName($product->name);
        $cartItemDto->setPrice($product->price);
        $cartItemDto->setImagePath($product->image_path);
        $cartItemDto->setQuantity(1);
        return $cartItemDto;
    }
}
