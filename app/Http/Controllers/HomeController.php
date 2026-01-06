<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    $latestProducts = Product::with('category')->latest()->take(4)->get();
    return view('home', compact('latestProducts'));
}
}
