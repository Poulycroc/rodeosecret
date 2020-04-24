<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return response()->json($categories);
  }

  public function create(Request $request)
  {
    $category = new Category;
    $category->name= $request->name;
    
    $category->save();
    
    return response()->json([
      'category' => $category,
      'categories' => Category::all()
    ]);
  }

  public function show($id)
  {
    return response()->json([
      'category' => Category::find($id)
    ]);
  }

  public function update(Request $request, $id)
  { 
    $category= Category::find($id);
    
    $category->name = $request->input('name');
    $category->save();
    
    return response()->json([
      'category' => $category,
      'categories' => Category::all()
    ]);
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();
    
    return response()->json([
      'category' => $category,
      'categories' => Category::all()
    ]);
  }
}
