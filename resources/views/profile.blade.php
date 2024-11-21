@extends('layouts.app')

@section('content')
<h1>Профиль пользователя</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text">{{ $user->email }}</p>
        @if ($user->avatar)
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="img-thumbnail" style="max-width: 150px;">
        @else
            <p>Аватар не установлен</p>
        @endif
        <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="avatar">Загрузить аватар:</label>
                <input type="file" name="avatar" id="avatar" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Обновить аватар</button>
        </form>
    </div>
</div>
@endsection