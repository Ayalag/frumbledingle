<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::get());
    }

    public function store(Request $request)
    {
        Category::create(['name' => $request->input('name'), 'parent_id' => null]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
