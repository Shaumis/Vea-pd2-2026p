<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{

    public function getTopSongs(): JsonResponse
    {
        $songs = Song::where('image', true)->inRandomOrder()->take(3)->get();
        return response()->json($songs);
    }

    public function getSong(Song $song): JsonResponse
    {
        $selectedSong = Song::where([ 'id' => $song->id, 'image' => true, ]) ->firstOrFail(); return response()->json($selectedSong);
    }

    public function getRelatedSongs(Song $song): JsonResponse
    {
        $songs = Song::with('voicebank')->where('image', true)->where('id', '<>', $song->id)->inRandomOrder()->take(3)->get();
        return response()->json($songs);
    }

}
