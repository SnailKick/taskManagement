@extends('layouts.app')

@section('content')
<h1>Добавить задачу</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Описание:</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="due_datetime">Срок выполнения:</label>
        <input type="datetime-local" name="due_datetime" id="due_datetime" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="assignee_id">Назначить пользователю:</label>
        <select name="assignee_id" id="assignee_id" class="form-control" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
@endsection