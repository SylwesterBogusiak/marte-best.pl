<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpsertProductRequest;

class ProductController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('products.index',[
            'products' => Product::paginate(3)
    ]);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create',[
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request): RedirectResponse
    {



        $product = new Product($request->validated());
        if ($request->hasFile('image'))
        {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show',[
            'product' => $product,
           
        ]
    );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',[
            'product' => $product,
            'categories' => ProductCategory::all()
        
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product): RedirectResponse
    {
        $product->fill($request->validated());
        if ($request->hasFile('image'))
        {
            $product->image_path = $request->file('image')->store('products');
        }

        $product->save();
        return redirect(route('products.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            
            $product->delete();
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
