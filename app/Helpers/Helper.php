<?php

namespace App\Helpers;

use App\Services\TodoService;

class Helper
{
    /**
     * serivce
     *
     * @var TodoService
     */
    public $service;

    // singletonやbindなどで設定したクラスは自動的にコンストラクタインジェクションがされる
    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return $this->service->create([
            'content' => 'hello',
        ]);
    }
}
