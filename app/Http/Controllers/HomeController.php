<?php

namespace App\Http\Controllers;

use App\Models\TravelPackages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = TravelPackages::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        return view('welcome', compact('packages'));
    }
}
