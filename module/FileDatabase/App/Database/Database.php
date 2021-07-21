<?php

namespace Module\FileDatabase\App\Database;

use Module\FileDatabase\App\Contract\{
    Database as Contract,
    Access,
};

/**
 * データベースを操作る方法を実装するためのインタフェース
 *
 * @package \Module\FileDatabase\App\Database;
 */
class Database implements Contract
{
    const DATA_KEY = 'data';
    const MAX_ID_KEY = 'max';

    /**
     * max id
     *
     * @var mixed
     */
    protected $maxID;

    /**
     * data list
     *
     * @var array
     */
    protected $dataList = [];


    /**
     * db access instance
     *
     * @var Access
     */
    protected $db;

    public function __construct(Access $db)
    {
        $this->db = $db;
        $this->db->load();
        $this->maxID = $this->db->data(self::MAX_ID_KEY, 0);
    }

    /**
     * idからレコード（配列）を返す　何もなければnull
     * idにnullを指定するとすべてのレコード（配列）を返す
     *
     * @param mixed $id
     * @return null|array
     */
    public function find($id = null): ?array
    {
        $db = $this->db->data(self::DATA_KEY);

        if (is_null($id)) {
            return $db;
        }
        if (isset($db[$id])) {
            return $db[$id];
        }
        return null;
    }

    /**
     * レコード（配列）を保存する
     *
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function save(array $data): array
    {
        $db = $this->db->data(self::DATA_KEY);

        $this->maxID++;
        $data['id'] = $this->maxID;
        $db[$this->maxID] = $data;
        $this->db->setData(self::DATA_KEY, $db);
        $this->db->setData('max', $this->maxID);
        $this->db->save();

        return $data;
    }

    /**
     * レコード（配列）を更新する
     *
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function update(array $data, $id): array
    {
        $db = $this->db->data(self::DATA_KEY);

        if (isset($db[$id])) {
            $data['id'] = $id;
            $db[$id] = $data;
            $this->db->setData(self::DATA_KEY, $db);
            $this->db->save();
        }
        return $data;
    }

    /**
     * idからレコードを削除する
     * idにnullを指定するとすべてのレコードを削除する
     *
     * @param array $data
     * @return bool
     */
    public function delete($id = null): bool
    {
        $db = $this->db->data(self::DATA_KEY);

        if (is_null($id)) {
            $this->db->setData(self::DATA_KEY, []);
            $this->db->save();

            return true;
        } else if (isset($db[$id])) {
            unset($db[$id]);
            $this->db->setData(self::DATA_KEY, $db);
            $this->db->save();

            return true;
        }

        return false;
    }
}
