<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Resources\PodcastResource;

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

    public function show(Podcast $podcast)
    {
        $podcast->load('category', 'episodes');
        return new PodcastResource($podcast);
    }
}
