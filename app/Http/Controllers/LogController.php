<?php

namespace App\Http\Controllers;

use App\Models\AlbumLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogController
{
  public static function log($album, $type)
  {
    $log = [
      'album_id' => $album->id,
      'type' => $type,
      'author' => $album->author,
      'name' => $album->name,
      'description' => $album->description,
      'cover_url' => $album->cover_url,
      'time' => Carbon::now()->toDateTimeString()
    ];

    if (Auth::user())
      $log['user_id'] = Auth::user()->id;

    DB::table('album_logs')->insert($log);
  }

  public static function logs()
  {
    return view('logs', ['logs' => AlbumLog::all(), 'title' => 'Логи']);
  }
}
