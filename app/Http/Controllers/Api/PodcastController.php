<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Resources\PodcastResource;
use App\Http\Requests\PodcastStoreRequest;

class PodcastController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/v1/podcasts",
 *     tags={"Podcasts"},
 *     summary="Get list of podcasts",
 *     @OA\Parameter(
 *         name="category_id",
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
    public function index(Request $request)
    {
        $query = Podcast::with('category');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $query->when($request->sort_by, fn($q, $sort) =>
            $q->orderBy($sort, $request->get('order', 'asc'))
        );

        $podcasts = $query->paginate(10);
        return PodcastResource::collection($podcasts);
    }

    /**
 * @OA\Post(
 *     path="/api/podcasts",
 *     tags={"Podcasts"},
 *     summary="Create a new podcast",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "category_id"},
 *             @OA\Property(property="title", type="string", example="Tech Talks"),
 *             @OA\Property(property="description", type="string", example="Daily tech updates"),
 *             @OA\Property(property="image", type="string", example="http://example.com/image.png"),
 *             @OA\Property(property="category_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(response=201, description="Created"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(PodcastStoreRequest $request)
    {
        $podcast = Podcast::create($request->validated());
        return response()->json($podcast, 201);
    }

    public function show(Podcast $podcast)
    {
        $podcast->load('category', 'episodes');
        return new PodcastResource($podcast);
    }
}
