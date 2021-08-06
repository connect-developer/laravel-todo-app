<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisterTodo;

class RegisterTodoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // コンストラクタインジェクションできる
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RegisterTodo $event)
    {
        dd('hello'); // ddやdumpっていうデバッグ用のヘルパ関数があある

        // リスナーにはイベントインスタンスがそのまま渡されるので
        // リスナー内で利用していく
        $event->todo->delete();
    }
}
