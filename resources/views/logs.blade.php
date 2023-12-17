@extends('parts.app')

@section('title'){{ $title }}@endsection

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User id</th>
            <th scope="col">Album id</th>
            <th scope="col">Author</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Cover</th>
            <th scope="col">Type</th>
            <th scope="col">Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            @if($log->type == 'CREATING')
                <tr class="table-success">
            @elseif($log->type == 'DELETING')
                <tr class="table-danger">
            @elseif($log->type == 'CHANGING')
                <tr class="table-info">
            @endif
                <th scope="row">{{ $log->id }}</th>
                <td>@if($log->user_id){{ $log->user_id }}@elseАноним@endif</td>
                <td>{{ $log->album_id }}</td>
                <td>{{ $log->author }}</td>
                <td>{{ $log->name }}</td>
                <td>{{ $log->description }}</td>
                <td><img src="{{$log->cover_url}}" class="rounded h-20" alt="..." style="width: 50px; height: 50px;"></td>
                <td>{{ $log->type }}</td>
                <td>{{ $log->time }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
