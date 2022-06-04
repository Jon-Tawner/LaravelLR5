@extends('layouts.app')

@section('title','Мои блоги')


@section('content')
        <a href='{{route('create_blog')}}' class="btn btn-success">Создать блог</a>
    
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

        <a href='{{route('edit_blog',$blog->id)}}' class="btn btn-primary">Изменить блог</a>
        
<br><br>
    @endforeach

    <br>
    {{$blogs->links()}}
@endsection