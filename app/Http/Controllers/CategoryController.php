<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $category = Category::all();
        return view('pages.dashboard.admin-dashboard.category.add-dategory', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Category' => 'required|string|max:255'
        ]);

        $data = new Category();
        $data->Category = $request->Category;
        $data->save();
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
