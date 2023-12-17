@extends('parts.app')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h4>Изменить пластинку</h4>
            <form action="{{ route('album-edit') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="inputAuthor" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="inputAuthor" name="author" value="{{ $album->author }}">
                </div>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Альбом</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{ $album->name }}">
                </div>
                <div class="mb-3">
                    <label for="inputDescription" class="form-label">Описание</label>
                    <textarea class="form-control" id="inputDescription" rows="3" name="description">{{ $album->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="inputPic" class="form-label">URL обложки</label>
                    <input type="text" class="form-control" id="inputPic" name="cover_url" value="{{ $album->cover_url }}">
                </div>

                <input type="hidden" name="id" value="{{ $album->id }}">

                <input type="submit" class="btn btn-primary" name="type" value="Изменить">
                <input type="submit" class="btn btn-danger" name="type" value="Удалить">
            </form>
        </div>
        <div class="col">
            <div class="d-flex h-100 flex-column justify-content-center">
                <h4>Предпросмотр</h4>

                <div class="card mb-3 row shadow-sm" style="max-width: 540px;">
                    <div class="row g-0" style="max-height: 200px">
                        <div class="col-md-4" style="max-height: 200px">
                            <img id="lookoutPic" src=@if($type == 'editing')"{{ $album->cover_url }}"@else"https://images.genius.com/1ed8617297a59bb387aa035bd43f5a36.1000x1000x1.jpg"@endif class="img-fluid rounded-start h-100" alt="Тут будет обложка">
                        </div>
                        <div class="col-md-8" style="max-height: 200px">
                            <div class="card-body">
                                <h5 class="card-title" id="lookoutName">@if($type == 'editing'){{ $album->name }}@elseТут будет ваше прекрасное название@endif</h5>
                                <h6 class="card-text" id="lookoutAuthor">@if($type == 'editing'){{ $album->author }}@elseА тут ваш замечательный автор@endif</h6>
                                <p class="card-text" id="lookoutDescription" style="max-height: 100px; text-overflow: ellipsis; overflow: hidden">@if($type == 'editing'){{ $album->description }}@elseА здесь? Конечно же описание пластинки!!!@endif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("inputAuthor").onchange = (el) => {
            document.getElementById("lookoutAuthor").innerHTML = el.target.value;
        }

        document.getElementById("inputName").onchange = (el) => {
            console.log(el.target.value);
            document.getElementById("lookoutName").innerHTML = el.target.value;
        }

        document.getElementById("inputDescription").onchange = (el) => {
            console.log(el.target.value);
            document.getElementById("lookoutDescription").innerHTML = el.target.value;
        }

        document.getElementById("inputPic").onchange = (el) => {
            document.getElementById("lookoutPic").src = el.target.value;
        }
    </script>
@endsection
