<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Podcast;
use App\Http\Resources\EpisodeResource;

class EpisodeController extends Controller
{

    /**
 * @OA\Get(
 *     path="/api/v1/episodes",
 *     tags={"Episodes"},
 *     summary="Get list of episodes",
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
        $episodes = Episode::withCount('podcasts')->paginate(10);
        return EpisodeResource::collection($episodes);
    }

    public function byPodcast(Podcast $podcast)
    {
        $episodes = $podcast->episodes()->paginate(10);
        return EpisodeResource::collection($episodes);
    }
    
/**
 * @OA\Post(
 *     path="/api/episodes",
 *     tags={"Episodes"},
 *     summary="Create a new episode",
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
 
    public function store(Podcast $podcast, EpisodeStoreRequest $request)
    {
        $episode = $podcast->episodes()->create($request->validated());
        return response()->json($episode, 201);
    }

    public function show(Episode $episode)
    {
        $episode->load('podcast');
        return new EpisodeResource($episode);
    }
}
