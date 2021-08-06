<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\RegisterTodo;

class RegisterTodoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:register';

    // $signature にコマンド名を記述する（コマンド名は決まりは特にないのでなんでも良い）

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(\App\Services\TodoService $service)
    {
        // handleメソッドにメソッドインジェクションでサービスクラスを注入する
        $todo = $service->create([
            'content' => 'Command',
        ]);

        // Facadeで定義したHelperはどこでも use などの定義をしなくても呼び出せる
        // \Helper::create();

        // eventヘルパー関数でイベントのインスタンスを生成して渡してイベントを発行する
        event(new RegisterTodo($todo));

        // info や error などのコマンドに文字列表示するメソッドもある
        $this->info('hello');

        return 0;
    }
}
