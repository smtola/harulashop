<?php
// app/Http/Controllers/CategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all(); // For parent category selection
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:categories,category_id',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created.');
    }
}