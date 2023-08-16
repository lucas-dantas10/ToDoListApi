<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryCreatedResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $query = Category::query()->where('user_id', $user->id)->get();
        return CategoryResource::collection($query);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::firstOrCreate([
            'name' => $data['name']
        ], [
            'name' => $data['name'],
            'user_id' => auth()->user()->id,
            'icon' => $data['icon'],
            'color' => $data['color'],
            'status_category' => true
        ]);

        // \dd($category);

        if (!$category->wasRecentlyCreated) {
            return \response([
                'message' => 'Você ja possui esta categoria'
            ], 422);
        }

        return response([
            'category' => new CategoryCreatedResource($category),
            'message' => 'Categoria criada!'
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
        
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
        
    // }
}
