<?php

namespace Module\FileDatabase\App\Contract;

/**
 * データベースの操作インタフェース
 *
 * @package \Module\FileDatabase\App\Contract
 */
interface Database
{
    /**
     * idからレコード（配列）を返す　何もなければnull
     * idにnullを指定するとすべてのレコード（配列）を返す
     *
     * @param mixed $id
     * @return null|array
     */
    public function find($id): ?array;

    /**
     * レコード（配列）を保存する
     *
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function save(array $data): array;

    /**
     * レコード（配列）を更新する
     *
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function update(array $data, $id): array;
    /**
     * idからレコードを削除する
     * idにnullを指定するとすべてのレコードを削除する
     *
     * @param array $data
     * @return bool
     */
    public function delete($id = null): bool;
}
