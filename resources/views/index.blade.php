@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    <form action="{{ route('api-get-data') }}" method="POST">
        @csrf
        <button type="submit">Получить данные</button>
    </form>
@endsection