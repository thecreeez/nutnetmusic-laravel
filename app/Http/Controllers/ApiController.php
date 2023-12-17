<?php

namespace App\Http\Controllers;

use Http;
use Config;
use Illuminate\Http\Request;

class ApiController extends Controller
{

  public function search($albumName)
  {
    $API_KEY = config('api.token');

    $response = Http::withOptions(['verify' => false])->get('https://ws.audioscrobbler.com/2.0/?method=album.search&album=' . $albumName . '&api_key='.$API_KEY.'&format=json');

    return array_slice($response['results']['albummatches']['album'],0,5);
  }

  /**
   * Useless rn
   */
  public function getAlbum($artistName, $albumName)
  {
    $API_KEY = config('api.token');

    $response = Http::withOptions(['verify' => false])->get('https://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist='.$artistName.'&album=' . $albumName . '&api_key=' . $API_KEY . '&format=json');

    $albumData = $response['album'];

    return json_encode([
      "image" => $albumData["image"][4]["#text"],
      "name" => $albumData["name"],
      "artist" => $albumData["artist"]
    ]);
  }
}
