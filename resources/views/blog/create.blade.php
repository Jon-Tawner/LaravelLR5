@extends('layouts.app')

@section('title','Создание блога')

@section('content')
    <form action="{{route('save_blog');}}" method="post" enctype="multipart/form-data">
        @csrf
        <p>
            Заголовок:
            <input name="title" maxlength="100" size="100" type="text">
        </p>
        Выберите картинку: <input type="file" name="img" size="10">
        <br>
        <br>
        <p>
            Контент:
            <br>
            <textarea name="text" cols="50" rows="10"></textarea>
        </p>
        <br>
        <button type="submit" class="btn btn-primary"></button>
        <input name="clean" type="reset" value="Очистить форму">
    </form>
@endsection