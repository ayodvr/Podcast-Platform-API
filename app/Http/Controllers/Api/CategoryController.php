<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/v1/categories",
 *     tags={"Categories"},
 *     summary="Get list of categories",
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string", example="title")
 *     ),
 *     @OA\Response(response=200, description="Successful response")
 * )
 */

    public function index()
    {
        $categories = Category::withCount('podcasts')->paginate(10);
        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->load('podcasts');
        return new CategoryResource($category);
    }
}
