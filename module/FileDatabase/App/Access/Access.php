<?php

namespace Module\FileDatabase\App\Access;

use Module\FileDatabase\App\Contract\Access as Contract;
use Exception;
use RuntimeException;

/**
 * ファイルDBのデータアクセスクラス
 *
 * @package \Module\FileDatabase\App\Access;
 */
class Access extends AbstractAccess implements Contract
{
    /**
     * 保存先ディレクトリパス
     *
     * @var string
     */
    protected $directory;

    public function __construct(string $directory, string $name)
    {
        $this->directory = $directory;

        parent::__construct($this->createPath($name, 'json'));
    }

    /**
     * ファイルDBからデータをロードする
     *
     * @return void
     */
    public function load(): bool
    {
        $result = true;

        try {
            $data = $this->loadData();
            $this->setValue(json_decode($data, true));
        } catch (Exception $e) {
            $result = false;
            $this->setValue([]);
        }

        return $result;
    }

    /**
     * ファイルDBのデータを保存する
     *
     * @return void
     */
    public function save()
    {
        $data = $this->value();
        if (!$data) {
            throw new RuntimeException(get_class($this) . '：保存するデータがありません');
        }
        $this->saveData(json_encode($data));
    }

    public function createPath(string $name, string $ext)
    {
        return $this->directory . DIRECTORY_SEPARATOR . $name . '.' . $ext;
    }
}
