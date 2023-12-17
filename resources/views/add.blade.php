@extends('parts.app')

@section('title')Добавление@endsection

@section('content')
<div class="row">
  <div class="col">
    <h4>Добавить пластинку</h4>
    <form action="{{ route('album-add') }}" method="post">
      @csrf

      <div class="mb-3">
        <label for="inputAuthor" class="form-label">Автор</label>
        <input type="text" class="form-control" id="inputAuthor" name="author">
      </div>
      <div class="mb-3">
        <label for="inputName" class="form-label">Альбом</label>
        <input type="text" class="form-control" id="inputName" name="name" data-bs-toggle="dropdown">
        <ul class="dropdown-menu" aria-labelledby="inputName" id="namesByApi"></ul>
      </div>
      <div class="mb-3">
        <label for="inputDescription" class="form-label">Описание</label>
        <textarea class="form-control" id="inputDescription" rows="3" name="description"></textarea>
      </div>

      <div class="mb-3">
        <label for="inputPic" class="form-label">URL обложки</label>
        <input type="text" class="form-control" id="inputPic" name="cover_url">
      </div>

      <button type="submit" class="btn btn-primary" name="edit">Добавить</button>
    </form>
  </div>
  <div class="col">
    <div class="d-flex h-100 flex-column justify-content-center">
      <h4>Предпросмотр</h4>

      <div class="card mb-3 row shadow-sm" style="max-width: 540px;">
        <div class="row g-0" style="max-height: 200px">
          <div class="col-md-4" style="max-height: 200px">
            <img id="lookoutPic" src="https://images.genius.com/1ed8617297a59bb387aa035bd43f5a36.1000x1000x1.jpg"
              class="img-fluid rounded-start h-100" alt="Тут будет обложка">
          </div>
          <div class="col-md-8" style="max-height: 200px">
            <div class="card-body">
              <h5 class="card-title" id="lookoutName">Тут будет ваше прекрасное название</h5>
              <h6 class="card-text" id="lookoutAuthor">А тут ваш замечательный автор</h6>
              <p class="card-text" id="lookoutDescription"
                style="max-height: 100px; text-overflow: ellipsis; overflow: hidden">А здесь? Конечно же описание
                пластинки!!!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection