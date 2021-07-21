<?php

namespace App\Contracts\Repository;

interface TodoRepository
{
    /**
     * データ追加
     *
     * @param array $inputs
     * @return mixed
     */
    public function create(array $inputs);

    /**
     * データ更新
     *
     * @param array $inputs
     * @param mixed $id
     * @return mixed
     */
    public function update(array $inputs, $id);

    /**
     * データ削除
     *
     * @param mixed $id
     * @return mixed
     */
    public function delete($id);

    /**
     * データ取得
     *
     * @param mixed $id
     * @return mixed
     */
    public function find($id);

    /**
     * 全てのデータ取得
     *
     * @return mixed
     */
    public function all();
}
