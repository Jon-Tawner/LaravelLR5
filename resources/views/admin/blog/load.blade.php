@extends('layouts.app')

@section('title','Загрузка блогов')

@section('content')
    <form action="{{route('unpack_file_bogs');}}" method="post" enctype="multipart/form-data">
        @csrf
        Выберите файл: <input type="file" name="file" size="10">
        <button type="submit" >Отправить</button>
        </form>
@endsection