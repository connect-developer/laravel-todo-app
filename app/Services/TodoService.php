<?php

namespace App\Services;

use App\Contracts\Service\TodoService as Contract;
use App\Contracts\Repository\TodoRepository;
use App\Enums\TodoStatus;

class TodoService implements Contract
{

    /**
     * main repository
     *
     * @var TodoRepository
     */
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Todoの追加
     *
     * @param array $inputs
     * @return mixed
     */
    public function create(array $inputs)
    {
        $inputs['status'] = TodoStatus::Ready;
        return $this->repository->create($inputs);
    }

    /**
     * Todoのステータス変更
     *
     * @param mixed $status
     * @param mixed $id
     * @return mixed
     */
    public function changeStatus($status, $id)
    {
        return $this->repository->update([
            'status' => $status,
        ], $id);
    }

    /**
     * Todoの削除
     *
     * @param mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Todoの取得
     *
     * @param mixed $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * 全てのTodo取得
     *
     * @return mixed
     */
    public function all()
    {
        return $this->repository->all();
    }
}
