<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    //
    public function index() {
        return response()->json(Song::all());
    }

    public function streamSong(Request $request) {
        $song = $request->input('audio_url');


    }

    public function store() {

    }
    public function getAudioFile(Request $request)
    {
        $songName = $request->input('audio_url'); 
        // Get the path to your audio file (change 'your-audio-file.mp3' to your file's name)
        $filePath = storage_path('app/public/' . $songName . '.mp3');

        // Check if the file exists
        /*
        if (!Storage::exists('public/your-audio-file.mp3')) {
            abort(404);
        }
        */

        // Set the headers for the response
        $headers = [
            'Content-Type' => 'audio/mpeg', // Adjust content type according to your audio file format
            'Content-Disposition' => 'inline; filename="your-audio-file.mp3"', // Adjust filename accordingly
        ];

        // Return the response with the file contents and headers
        return response()->file($filePath, $headers);
    }

    

}


