<?php

namespace App\Http\Controllers;

use app;
use App\Models\SongLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SongLocalController extends Controller
{
    //
    public function index() {
        return response()->json(SongLocal::all());
    }
    public function uploadSongFile(Request $request) {
      

   
        $audioFile = $request->file('audio_file');
        $fileExtension = $request->input('file_extension');
        //$storagePath = '\/local_artists/';
        //Storage::put('local_artists/', $request->input('title').$fileExtension, $audioFile);

        $path = $audioFile->storeAs('public/local_artists', $request->input('title') . '.' . $fileExtension);
        //dd($path);



//$filePath = 'local_artists/' . $request->input('title') . $fileExtension;

//Storage::put($filePath, $audioFile);


        // SongLocal::create([
        //     'artist' => $request->input('artist'),
        //     'title' => $request->input('title'),
        //     'genre' => $request->input('genre'),
        //     'likes' => 0,
        //     'dislikes' => 0,
        //     'approved' => false,
        //     'release_date' => $request->input('release_date'),

        // ]);
//  $data = $request->only([
//         'artist',
//         //'title',
//         'genre',
//         'approved',
//         'release_date',
//     ]);
//     // $filee = $request->validate([
        
    

// $data['approved'] = filter_var($data['approved'], FILTER_VALIDATE_BOOLEAN);
         //Log::info('Request received:', $request->all());
         $rawValue = $request->input('approved');
         $boolean = filter_var($rawValue, FILTER_VALIDATE_BOOLEAN);

         $validData = [
            'artist' => $request->input('artist'),
            'title' => $request->input('title'),
            'genre' => $request->input('genre'),
            'release_date' => $request->input('release_date'),
         ];
         
        $songLocal = new SongLocal($validData);
        $songLocal->approved = $boolean;
        //SongLocal::validateData($data);

//dd($songLocal);
        
        $songLocal->likes = 0;
        $songLocal->dislikes = 0;
        $songLocal->save();
        //dd($songLocal);
        //dd($songLocal);
        //dd($songLocal->approved);

        //$audioFile->storeAs($storagePath, $request->input('title') . $fileExtension);
        //Log::info('Response sent:', ['message' => 'File uploaded successfully']);
        return response()->json([
            //'file' => $storagePath . $request->input('title') . $fileExtension,
        ]); 
    }

    public function approveLocalSong(Request $request) {
        $title = $request->input('title');
        $song = SongLocal::where('title', $title)->first();

        if (!$song) {
            return response()->json([
                'message' => 'failure',
            ], 404);
        } 
        $song->approved = true;
        $song->save();
        return response()->json([
            'message' => 'successful',
        ], 200);

    }

    public function getLocalAudioFile(Request $request)
    {
        $songName = $request->input('audio_url'); 
        // Get the path to your audio file (change 'your-audio-file.mp3' to your file's name)
        $filePath = storage_path('app/public/local_artists/' . $songName . '.mp3');

        // Set the headers for the response
        $headers = [
            'Content-Type' => 'audio/mpeg', // Adjust content type according to your audio file format
            'Content-Disposition' => 'inline; filename="{$songName}.mp3"', // Adjust filename accordingly
        ];

        // Return the response with the file contents and headers
        return response()->file($filePath, $headers);
    }
}



 

   

// $data = $request->only([
//     'artist',
//     'title',
//     'genre',
//     'approved',
//     'release_date',
// ]);

// // Cast 'approved' to boolean

// // Validate the data
// SongLocal::validateData($data);

// // Create a new instance of the model and save it to the database
// $songLocal = new SongLocal($data);
// $songLocal->save();
