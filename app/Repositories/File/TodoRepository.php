<?php

namespace App\Repositories\File;

use App\Contracts\Repository\TodoRepository as Repository;
use App\Models\Todo;
use Illuminate\Support\Arr;
use Illuminate\Database\RecordsNotFoundException;
use Module\FileDatabase\App\Database\{
    Manager,
    Database,
};

/**
 * FileDatabaseによるリポジトリーの具象クラス
 *
 * @package \App\Repositories\File
 */
class TodoRepository implements Repository
{
    /**
     * file database
     *
     * @var Manager
     */
    private $db;

    public function __construct(Manager $db)
    {
        $this->db = $db;
    }

    /**
     * データベースインスタンス取得
     *
     * @return Database
     */
    protected function db(): Database
    {
        return $this->db->db('todos');
    }

    /**
     * 必要なデータのみを取得
     *
     * @param array $inputs
     * @return array
     */
    protected function onlyInputs(array $inputs)
    {
        return Arr::only($inputs, [
            'content',
            'status',
        ]);
    }

    /**
     * データ追加
     *
     * @param array $inputs
     * @return mixed
     */
    public function create(array $inputs)
    {
        return new Todo(
            $this->db()->save(
                $this->onlyInputs($inputs)
            )
        );
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
        $this->find($id);

        $todo = $this->db()->find($id);

        $inputs = array_merge($todo, $inputs);
        return new Todo(
            $this->db()->update(
                $this->onlyInputs($inputs),
                $id
            )
        );
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
        $this->db()->delete($id);
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
        $todo = $this->db()->find($id);

        if (!$todo) {
            throw new RecordsNotFoundException("not found record id:[{$id}]");
        }

        return new Todo($todo);
    }

    /**
     * 全てのデータ取得
     *
     * @return mixed
     */
    public function all()
    {
        $result = [];

        $todos = $this->db()->find() ?? [];

        foreach ($todos as $todo) {
            $model = new Todo($todo);
            $model->id = $todo['id'];
            $result[] = $model;
        }
        return collect($result);
    }
}
