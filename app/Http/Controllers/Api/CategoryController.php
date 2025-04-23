<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryStoreRequest;


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

/**
 * @OA\Post(
 *     path="/api/categories",
 *     tags={"Categories"},
 *     summary="Create a new category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "slug"},
 *             @OA\Property(property="name", type="string", example="Technology"),
 *             @OA\Property(property="slug", type="string", example="technology")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Created"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        $category->load('podcasts');
        return new CategoryResource($category);
    }
}
