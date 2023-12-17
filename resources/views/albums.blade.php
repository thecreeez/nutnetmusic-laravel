@extends('parts.app')

@section('title')Альбомы@endsection

@section('content')
<div class="d-flex flex-column align-items-center">
  @foreach($data as $el)
  <div class="card mb-3 row shadow-sm" style="width: 540px;">

    <div class="row g-0" style="max-height: 200px">
      <div class="col-md-4" style="max-height: 200px">
        <a href="/edit/{{ $el->id }}"><img src="{{ $el->cover_url }}" class="img-fluid rounded-start h-100 album-picture"
            alt="..."></a>
      </div>
      <div class="col-md-8" style="max-height: 200px">
        <div class="card-body">
          <h5 class="card-title">{{ $el->name }}</h5>
          <h6 class="card-text">{{ $el->author }}</h6>
          <p class="card-text" style="max-height: 70px; text-overflow: ellipsis; overflow: hidden">{{ $el->description }}</p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

<nav aria-label="Page navigation">
  @if($currentPage != $lastPage && $currentPage < 2)
    <ul class="pagination justify-content-center">
      @if($currentPage > 1)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage - 1 }}">Предыдущая</a>
        </li>
      @endif
      @if ($currentPage <= 1) 
        <li class="page-item disabled">
          <a class="page-link" href="/albums/{{ $currentPage - 1 }}">Предыдущая</a>
        </li>
      @endif
      @if ($currentPage > 2)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage - 2 }}">{{ $currentPage - 2 }}</a>
        </li>
      @endif
      @if ($currentPage > 1)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage - 1 }}">{{ $currentPage - 1 }}</a>
        </li>
      @endif
      <li class="page-item active"><a class="page-link" href="#">{{ $currentPage }}</a></li>
      @if($lastPage > $currentPage)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage + 1 }}">{{ $currentPage + 1 }}</a>
        </li>
      @endif
      @if($lastPage > $currentPage + 1)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage + 2 }}">{{ $currentPage + 2 }}</a>
        </li>
      @endif
      @if($lastPage > $currentPage)
        <li class="page-item">
          <a class="page-link" href="/albums/{{ $currentPage + 1 }}">Следующая</a>
        </li>
      @endif
      @if($lastPage <= $currentPage) 
        <li class="page-item disabled">
          <a class="page-link" href="/albums/{{ $currentPage + 1 }}">Следующая</a>
        </li>
      @endif
    </ul>
  @endif
</nav>
@endsection