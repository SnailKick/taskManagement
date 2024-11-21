@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Менеджер задач</h1>
    <p>Эффективно управляйте своими задачами с помощью нашего простого и интуитивно понятного менеджера задач.</p>

    @auth
        <a href="{{ route('tasks.index') }}">Просмотреть свои задачи</a>
    @else
        <a href="{{ route('login') }}">Войти</a> или <a href="{{ route('register') }}">Зарегистрироваться</a>, чтобы начать.
    @endauth

    <h2>Действующие задачи</h2>
    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item">
                <strong>{{ $task->title }}</strong>
                <br>
                {{ $task->description }}
                <br>
                Срок выполнения: {{ $task->due_datetime }}
                <br>
                Назначена пользователю: {{ $task->assignee ? $task->assignee->name : 'Не назначен' }}
                <br>
                Поставлена: {{ $task->user->name }}
                <br>
                Статус: {{ $task->status }}
                <br>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">Перейти</a>
                
            </li>
        @endforeach
    </ul>
@endsection