@extends('layouts.base')

@section('title', 'Главная')

@section('main')
    @if (Session::has('success')) <p style="color: green">{{ session('success') }}</p> @endif
    @if (Session::has('error')) <p style="color: red">{{ session('error') }}</p> @endif

    <form action="{{ route('api-get-incomes') }}" method="POST">
        @csrf
        <h4>Данные о поставках</h4>
        <p><label for="incomes-dateFrom">
            От
            <input type="datetime-local" name="dateFrom" id="incomes-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-incomes') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-incomes') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>

    <form action="{{ route('api-get-stocks') }}" method="POST">
        @csrf
        <h4>Данные о складах</h4>
        <p><label for="stocks-dateFrom">
            От 
            <input type="datetime-local" name="dateFrom" id="stocks-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-stocks') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-stocks') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>

    <form action="{{ route('api-get-orders') }}" method="POST">
        @csrf
        <h4>Данные о заказах</h4>
        <p><label for="orders-dateFrom">
            Дата
            <input type="datetime-local" name="dateFrom" id="orders-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <p><label for="orders-flag">
            flag
            <select name="flag" id="orders-flag">
                <option value="1">1</option>
                <option value="0">0</option>
            </select>
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-orders') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-orders') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>

    <form action="{{ route('api-get-sales') }}" method="POST">
        @csrf
        <h4>Данные о продажах</h4>
        <p><label for="sales-dateFrom">
            Дата
            <input type="datetime-local" name="dateFrom" id="sales-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <p><label for="sales-flag">
            flag
            <select name="flag" id="sales-flag">
                <option value="1">1</option>
                <option value="0">0</option>
            </select>
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-sales') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-sales') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>

    <form action="{{ route('api-get-sales-reports') }}" method="POST">
        @csrf
        <h4>Данные по отчету о продажах реализации</h4>
        <p><label for="sales-dateFrom">
            От
            <input type="datetime-local" name="dateFrom" id="sales-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <p><label for="sales-dateto">
            До
            <input type="datetime-local" name="dateto" id="sales-dateto" value="2022-07-07T00:00">
        </label></p>
        <p><label for="sales-reports-limit">
            Кол-во записей
            <input type="number" name="limit" id="sales-reports-limit" value="1000">
        </label></p>
        <p><label for="sales-reports-rrdid">
            rrdid
            <input type="number" name="rrdid" id="sales-reports-rrdid" value="0">
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-sales-reports') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-sales-reports') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>
    <form action="{{ route('api-get-excises-reports') }}" method="POST">
        @csrf
        <h4>Данные по отчету по КиЗам</h4>
        <p><label for="excises-reports-dateFrom">
            От 
            <input type="datetime-local" name="dateFrom" id="excises-reports-dateFrom" value="2022-07-07T00:00">
        </label></p>
        <button type="submit">Получить</button>
    </form>
    <form action="{{ route('show-excises-reports') }}" method="POST">
        @csrf
        <button type="submit">Показать</button>
    </form>
    <form action="{{ route('send-excises-reports') }}" method="POST">
        @csrf
        <button type="submit">Загрузить в PowerBI</button>
    </form>
@endsection