@extends('layouts.app')

@section('content')
<h1>История задач</h1>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#assigned">Поставленные мной</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#my">Мои задачи</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="assigned">
        <ul class="list-group">
            @foreach ($assignedTasks as $task)
                <li class="list-group-item">
                    <strong>{{ $task->title }}</strong>
                    <br>
                    {{ $task->description }}
                    <br>
                    Срок выполнения: {{ $task->due_datetime }}
                    <br>
                    Назначена пользователю: {{ $task->assignee ? $task->assignee->name : 'Не назначен' }}
                    <br>
                    Статус: {{ $task->status }}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-pane fade" id="my">
        <ul class="list-group">
            @foreach ($myTasks as $task)
                <li class="list-group-item">
                    <strong>{{ $task->title }}</strong>
                    <br>
                    {{ $task->description }}
                    <br>
                    Срок выполнения: {{ $task->due_datetime }}
                    <br>
                    Поставлена: {{ $task->user->name }}
                    <br>
                    Статус: {{ $task->status }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection