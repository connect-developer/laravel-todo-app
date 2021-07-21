<?php

namespace Module\FileDatabase\App\Access;

use IteratorAggregate;
use RuntimeException;

/**
 * @package \Module\FileDatabase\App\Access;
 */
abstract class AbstractAccess implements IteratorAggregate
{
    /**
     * data
     *
     * @var null|array
     */
    private $value = null;

    /**
     * filepath
     *
     * @var null|string
     */
    private $filePath = null;

    /**
     * encode
     *
     * @var string
     */
    private $encode = 'UTF-8';

    function getIterator()
    {
        $value = $this->value();
        if (!$value) {
            return;
        }
        foreach ($value as $key => $val) {
            yield $key => $val;
        }
    }

    public function __construct(string $path)
    {
        $this->filePath = $path;
    }

    public function setEncode(string $encode)
    {
        $this->encode = $encode;

        return $this;
    }

    public function getEncode(): string
    {
        return $this->encode;
    }

    public function getPath(): ?string
    {
        return $this->filePath;
    }

    public function exists(): bool
    {
        return is_readable($this->getPath());
    }

    public function delete()
    {
        unlink($this->getPath());
    }

    protected function loadData()
    {
        if (!$this->exists()) {
            throw new RuntimeException(get_class($this) . '：ファイルが存在しない or 読み込み不可です');
        }

        $data = file_get_contents($this->getPath());
        return mb_convert_encoding($data, $this->getEncode(), 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    }

    protected function saveData($data)
    {
        if (is_null($data)) {
            throw new RuntimeException(get_class($this) . '：保存データが空です');
        }

        $this->createDirectory($this->getPath());
        file_put_contents($this->getPath(), $data);
    }

    private function createDirectory(string $filePath, $mode = 0777)
    {
        if (!file_exists($filePath)) {
            $info = pathinfo($filePath);
            if (!is_readable($info['dirname'])) {
                mkdir($info['dirname'], $mode, true);
            }
        }
    }

    public function getSaveTime()
    {
        if (!$this->exists()) {
            return false;
        }
        return filemtime($this->getPath());
    }

    public function isOverTime($addTime): bool
    {
        $time = time();
        $saveTime = $this->getSaveTime();
        if ($saveTime) {
            if ($saveTime + $addTime < $time) {
                return true;
            }
        } else {
            return true;
        }
        return false;
    }

    public function setValue(array $value)
    {
        $this->value = $value;

        return $this;
    }

    public function value(): ?array
    {
        return $this->value;
    }

    public function clearValue()
    {
        $this->value = null;

        return $this;
    }

    public function hasData(string $key): bool
    {
        return (!is_null($this->value) && isset($this->value[$key]));
    }

    public function clearData(string $key)
    {
        if ($this->hasData($key)) {
            unset($this->value[$key]);
        }
    }

    public function setData(string $key, $data)
    {
        if (is_null($this->value)) {
            $this->value = [];
        }
        $this->value[$key] = $data;
    }

    public function data(string $key, $default = null)
    {
        if ($this->hasData($key)) {
            return $this->value[$key];
        }
        return $default;
    }
}
