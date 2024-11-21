@extends('layouts.app')

@section('content')
<h1>Мои задачи</h1>

<a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Добавить задачу</a>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#pending">Ожидающие</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#completed">Выполненные</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#rejected">Отмененные</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#assigned">Поставленные</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="pending">
        <ul class="list-group">
            @foreach ($pendingTasks as $task)
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
                    @if ($task->user_id === Auth::id())
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    @elseif ($task->assignee_id === Auth::id())
                        @if ($task->status === 'pending')
                            <form action="{{ route('tasks.accept', $task) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Принять</button>
                            </form>
                            <form action="{{ route('tasks.reject', $task) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                            </form>
                        @elseif ($task->status === 'accepted')
                            <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Завершить</button>
                            </form>
                            <form action="{{ route('tasks.reject', $task) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                            </form>
                        @endif
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-pane fade" id="completed">
        <ul class="list-group">
            @foreach ($completedTasks as $task)
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
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-pane fade" id="rejected">
        <ul class="list-group">
            @foreach ($rejectedTasks as $task)
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
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-pane fade" id="assigned">
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
                    <br>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Редактировать</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection