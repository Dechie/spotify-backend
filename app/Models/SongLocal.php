<?php

namespace App\Models;


use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SongLocal extends Model
{
    use HasFactory;
    protected $fillable = [
        'artist',
        'title',
        'genre',
        'likes',
        'dislikes',
        'approved',
        'release_date',
    ];

    public static function validateData(array $data)
    {
        return Validator::make($data, [
            'artist' => 'required',
            //'title' => 'required|unique:song_locals',
            //'title' => 'required|unique:song_locals',
            'genre' => 'required',
            'approved' => 'required',
            'release_date' => 'required',
        ])->validate();
    }
}
