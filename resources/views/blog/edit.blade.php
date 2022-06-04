@extends('layouts.app')

@section('title','Редактирование блога')

@section('content')
    <form method="post" action="{{route('update_blog',$blog)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <p>
            Заголовок:
            <input name="title" maxlength="100" size="100" type="text" value="{{$blog->title}}">
        </p>
        Выберите картинку: <input type="file" name="img" size="10" src="{{$blog->img}}">
        <br>
        <br>
        <p>
            Контент:
            <br>
            <textarea name="content" cols="50" rows="10">{{$blog->content}}</textarea>
        </p>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection