<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->role === 'admin'){   
                // Fetch all categories with their product counts
                $categories = Category::withCount('products')->get();
                return view('dashboard', compact('categories'));
            }
            elseif($user->role === 'seller'){
                return redirect()->route('products.index'); 
            }
            else{
                return redirect()->route('home'); 
            }
        }
    }
}