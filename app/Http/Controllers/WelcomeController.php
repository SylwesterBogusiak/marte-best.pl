<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('welcome',[
            'products' => Product::paginate(10)
    ]);

        
    }

    
}
