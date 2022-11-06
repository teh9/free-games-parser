<?php

namespace app\Service;

use app\interfaces\File;

class FileHandler implements File
{
    /**
     * @var string
     */
    private string $filePath;

    /**
     * @return string
     */
    public function readFile(): string
    {
        return file_get_contents($this->filePath);
    }

    /**
     * @param array $params
     * @return bool|int
     */
    public function saveFile(array $params): bool|int
    {
        $file  = fopen($this->filePath, 'w');
        $state = fwrite($file, json_encode($params));
        fclose($file);

        return ($state);
    }

    /**
     * @param string $filePath
     * @return $this
     */
    public function setFilePath (string $filePath): static
    {
        $this->filePath = $filePath;
        return $this;
    }
}
