<?php

namespace Module\FileDatabase\App\Contract;

/**
 * データベースのアクセスインタフェース
 *
 * @package \Module\FileDatabase\App\Contract
 */
interface Access
{
    /**
     * ファイルDBからデータをロードする
     *
     * @return boolean
     */
    public function load(): bool;

    /**
     * ファイルDBのデータを保存する
     *
     * @return void
     */
    public function save();

    /**
     * ファイルDBのデータが存在するか
     *
     * @param string $key
     * @return boolean
     */
    public function hasData(string $key): bool;

    /**
     * ファイルDBのデータをクリアする
     *
     * @param string $key
     */
    public function clearData(string $key);

    /**
     * ファイルDBのデータをセットする
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function setData(string $key, $data);

    /**
     * ファイルDBのデータを取得する
     *
     * @param string $key
     * @param mixed $default
     * @return null|mixed
     */
    public function data(string $key, $default = null);
}
