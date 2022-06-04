@extends('layouts.app')

@section('title','Все блоги')


@section('content')
    @foreach ($blogs as $blog)
        <div class="blog">
            <p>Create_at: {{ $blog->created_at }}</p>
            <p>Update_at: {{$blog->updated_at }}</p>
            <p>{{ $blog->title }}</p>
            @if (!empty($blog->img))
                <div class='photo'> <img class='img' style='height: 200px' src='/website/public/blog/img/" . $value->img . "'></div>;
            @endif
            <p>{{ $blog->content }}</p>
        </div>
        
        @if (Auth::user() && Auth::user()->hasRole('admin'))
        <a href='{{route('edit_blog',$blog)}}' class="btn btn-primary">Изменить блог</a>
        <a href='{{route('delete_blog',$blog)}}' class="btn btn-danger">Удалить блог</a>
        @endif
        
        <br><br>
    @endforeach

    <br>
    {{$blogs->links()}}
@endsection