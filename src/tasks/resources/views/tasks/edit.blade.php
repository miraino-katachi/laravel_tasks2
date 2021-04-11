@extends('layouts.app')

<style>
    input[type="date"] {
        width: 200px;
    }
</style>

@section('content')

<h1>タスクを修正</h1>
<form action="{{ route('tasks.update', $task) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror "
            value="{{ old('title', $task->title) }}">
        @error('title')
        <div id="validateTitle" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="expiration_date">期限日</label>
        <input type="date" name="expiration_date" id="expiration_date"
            class="form-control @error('expiration_date') is-invalid @enderror "
            value="{{ old('expiration_date',$task->expiration_date) }}">
        @error('expiration_date')
        <div id="validateExpirationDate" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="completion_date">完了日</label>
        <input type="date" name="completion_date" id="completion_date"
            class="form-control @error('completion_date') is-invalid @enderror "
            value="{{ old('completion_date', $task->completion_date) }}">
        @error('completion_date')
        <div id="validateCompletionDate" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">説明</label>
        <textarea name="description" id="descriptin" rows="5"
            class="form-control @error('description') is-invalid @enderror ">{{ old('description', $task->description) }}</textarea>
        @error('description')
        <div id="validateDescription" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">送信</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">戻る</a>
</form>

@endsection