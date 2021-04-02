@extends('layouts.app')

@section('content')

<h1>タスク詳細</h1>
<table class="table">
    <tr>
        <th>登録日</th>
        <td>{{ $task->registration_date }}</td>
    </tr>
    <tr>
        <th>タイトル</th>
        <td>{{ $task->title }}</td>
    </tr>
    <tr>
        <th>期限日</th>
        <td>{{ $task->expiration_date }}</td>
    </tr>
    <tr>
        <th>完了日</th>
        <td>{{ $task->completion_date }}</td>
    </tr>
    <tr>
        <th>説明</th>
        <td>{!! nl2br(e($task->description)) !!}</td>
    </tr>
</table>
<a href="{{ route('tasks.index') }}" class="btn btn-primary">もどる</a>

@endsection