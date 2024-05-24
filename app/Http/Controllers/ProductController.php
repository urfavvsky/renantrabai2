<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.home');
    }

    public function create()
    {
        return view('admin.product.create');
    }
}
