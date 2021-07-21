<?php

namespace App\Contracts\Service;

interface TodoService
{
    /**
     * Todoの追加
     *
     * @param array $inputs
     * @return mixed
     */
    public function create(array $inputs);

    /**
     * Todoのステータス変更
     *
     * @param mixed $status
     * @param mixed $id
     * @return mixed
     */
    public function changeStatus($status, $id);

    /**
     * Todoの削除
     *
     * @param mixed $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Todoの取得
     *
     * @param mixed $id
     * @return mixed
     */
    public function find($id);

    /**
     * 全てのTodo取得
     *
     * @return mixed
     */
    public function all();
}
