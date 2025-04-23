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
 *     path="/api/podcasts/{podcast}/episodes",
 *     summary="Get all episodes for a given podcast",
 *     tags={"Episodes"},
 *     @OA\Parameter(
 *         name="podcast",
 *         in="path",
 *         required=true,
 *         description="Podcast ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Episode")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Podcast not found"
 *     )
 * )
 */

    public function byPodcast(Podcast $podcast)
    {
        $episodes = $podcast->episodes()->paginate(10);
        return EpisodeResource::collection($episodes);
    }

    public function show(Episode $episode)
    {
        $episode->load('podcast');
        return new EpisodeResource($episode);
    }
}
