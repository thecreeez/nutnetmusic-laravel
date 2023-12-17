<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{

  public function add(Request $req)
  {
    $album = new Album();

    if (!$req->author)
      return redirect(route('add'))->withErrors(['error' => 'Не удалось создать альбом: Не указан автор!']);

    $album->author = $req->input('author');

    if (!$req->name)
      return redirect(route('add'))->withErrors(['error' => 'Не удалось создать альбом: Не указано имя альбома!']);

    $album->name = $req->input('name');

    if (!$req->description)
      return redirect(route('add'))->withErrors(['error' => 'Не удалось создать альбом: Не указано описание альбома!']);

    $album->description = $req->input('description');

    if (!$req->cover_url)
      return redirect(route('add'))->withErrors(['error' => 'Не удалось создать альбом: Нет ссылки на обложку!']);

    if (strlen($req->cover_url) > 255)
      return redirect(route('add'))->withErrors(['error' => 'Не удалось создать альбом: Слишком длинная ссылка!']);

    $album->cover_url = $req->input('cover_url');

    $album->save();

    LogController::log($album, 'CREATING');

    return redirect(route('index'))->withErrors(['success' => 'Альбом успешно добавлен!']);
  }

  public function edit(Request $req)
  {
    $albums = new Album();
    $album = $albums->find($req->id);

    if (!$album)
      return redirect(route('index'))->withErrors(['error' => 'Альбом не найден']);

    if ($req->type == 'Изменить') {
      $album->name = $req->name;
      $album->author = $req->author;
      $album->description = $req->description;
      $album->cover_url = $req->cover_url;

      $album->save();
      LogController::log($album, 'CHANGING');

      return redirect(route('index'))->withErrors(['success' => 'Альбом успешно изменен!']);
    } else if ($req->type == 'Удалить') {
      LogController::log($album, 'DELETING');
      $album->delete();

      return redirect(route('index'))->withErrors(['success' => 'Альбом успешно удален!']);
    }
  }

  public function firstPage()
  {
    return $this->viewPage(1);
  }

  public function viewPage($page)
  {
    $maxAlbumsOnPage = 4;

    $albums = Album::all();
    $data = [];

    $maxPage = ceil($albums->count() / $maxAlbumsOnPage);

    if ($maxPage < $page && $page != 1)
      return redirect('/')->withErrors(['error' => 'Вы ушли куда-то далеко! Перемещаем вас в начало!']);

    $firstAlbum = ($maxAlbumsOnPage * $page) - $maxAlbumsOnPage;
    $lastAlbum = $maxAlbumsOnPage * $page;

    if ($lastAlbum > $albums->count())
      $lastAlbum = $albums->count();

    for ($i = $firstAlbum; $i < $lastAlbum; $i++) {
      $data[] = $albums->get($i);
    }

    return view('albums', ['data' => $data, 'lastPage' => $maxPage, 'currentPage' => $page]);
  }

  public function editAlbum($id)
  {
    $albums = new Album();
    $album = $albums->find($id);

    return view('edit', ['title' => 'Редактирование альбома', 'album' => $album, 'type' => 'editing']);
  }

}
