<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->task()
            ->orderBy('completion_date', 'asc')
            ->orderBy('expiration_date', 'asc')
            ->orderBy('registration_date', 'asc')
            ->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \app\Task $task
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->fill($request->all());
        // ログインユーザーID
        $task->user_id = Auth::user()->id;
        // 登録日は現在の年月日
        $task->registration_date = date('Y-m-d');
        $task->save();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $this->checkUserID($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->checkUserID($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->checkUserID($task);
        $task->fill($request->all())->save();
        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->checkUserID($task);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    /**
     * ログインユーザーIDとタスクのユーザーIDが異なるときにHttpExceptionをスローする
     *
     * @param Task $task
     * @param integer $status
     * @return void
     */
    protected function checkUserID(Task $task, int $status = 404)
    {
        // ログインユーザーIDとタスクのユーザーIDが異なるとき
        if (Auth::user()->id != $task->user_id) {
            // HTTPレスポンスステータスコードを返却
            abort($status);
        }
    }
}
