<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
