<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repository\TodoRepository as Repository;
use App\Models\Todo;


/**
 * Eloquentモデルによるリポジトリーの具象クラス
 *
 * @package \App\Repositories\Eloquent
 */
class TodoRepository implements Repository
{
    /**
     * データ追加
     *
     * @param array $inputs
     * @return mixed
     */
    public function create(array $inputs)
    {
        return Todo::create($inputs);
    }

    /**
     * データ更新
     *
     * @param array $inputs
     * @param mixed $id
     * @return mixed
     */
    public function update(array $inputs, $id)
    {
        $todo = $this->find($id);
        return $todo->update($inputs);
    }

    /**
     * データ削除
     *
     * @param mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        $todo = $this->find($id);
        $todo->delete();
        return $todo;
    }

    /**
     * データ取得
     *
     * @param mixed $id
     * @return mixed
     */
    public function find($id)
    {
        return Todo::findOrFail($id);
    }

    /**
     * 全てのデータ取得
     *
     * @return mixed
     */
    public function all()
    {
        return Todo::all();
    }
}
