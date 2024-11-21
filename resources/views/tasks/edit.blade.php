@extends('layouts.app')

@section('content')
<h1>Редактировать задачу</h1>

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Описание:</label>
        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="due_datetime">Срок выполнения:</label>
        <input type="datetime-local" name="due_datetime" id="due_datetime" class="form-control" value="{{ $task->due_datetime }}" required>
    </div>
    <div class="form-group">
        <label for="assignee_id">Назначить пользователю:</label>
        <select name="assignee_id" id="assignee_id" class="form-control" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $task->assignee_id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection