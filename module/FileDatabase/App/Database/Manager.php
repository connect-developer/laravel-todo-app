<?php

namespace Module\FileDatabase\App\Database;

use Module\FileDatabase\App\Contract\Database as Contract;
use Illuminate\Filesystem\Filesystem;

use Module\FileDatabase\App\Access\Access;

/**
 * データベースマネージャ
 *
 * @package \Module\FileDatabase\App\Database;
 */
class Manager
{
    /**
     * db list
     *
     * @var array<Contract>
     */
    protected $dbList = [];

    /**
     * 保存先ディレクトリパス
     *
     * @var string
     */
    protected $directory;

    /**
     * ファイル操作用
     *
     * @var Filesystem
     */
    protected $files;

    public function __construct(string $directory, Filesystem $files)
    {
        $this->directory = $directory;
        $this->files = $files;

        $this->checkAndMakeDirectory();
    }

    /**
     * ディレクトリチェック
     *
     * @return void
     */
    protected function checkAndMakeDirectory()
    {
        if (!$this->files->exists($this->directory)) {
            $this->files->makeDirectory($this->directory, 0755, true);
        }
    }

    public function db(string $table): Contract
    {
        if (isset($this->dbList[$table])) {
            return $this->dbList[$table];
        }

        $db = new Database(new Access($this->directory, $table));

        $this->dbList[$table] = $db;

        return $db;
    }
}
