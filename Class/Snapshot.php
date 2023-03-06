<?php

namespace App;

class Snapshot
{
    private const DATA_FILE = __DIR__."/../data.json";
    private int $blocks;
    private int $size;
    private \DateTimeInterface $updateTime;
    private string $version;

    public function load()
    {
        if(!file_exists(self::DATA_FILE)) {
            die("Data file dont exists. Run script 'php update_info.php'");
        }

        $data = json_decode(file_get_contents(self::DATA_FILE), true);

        $this->blocks = $data['blocks'];
        $this->size = $data['size'];
        $this->updateTime = new \DateTime();
        $this->updateTime->setTimestamp($data['update_time']);
        $this->version = $data['version_tag'];
    }

    public function save(): bool
    {
        $data = [
            "blocks" => $this->getBlocks(),
            "size" => $this->getSize(),
            "update_time" => $this->getUpdateTime()->getTimestamp(),
            "version_tag" => $this->getVersion()
        ];

       return file_put_contents(self::DATA_FILE, json_encode($data));
    }

    /**
     * @return int
     */
    public function getBlocks(): int
    {
        return $this->blocks;
    }

    /**
     * @param int $blocks
     * @return Snapshot
     */
    public function setBlocks(int $blocks): Snapshot
    {
        $this->blocks = $blocks;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Snapshot
     */
    public function setSize(int $size): Snapshot
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdateTime(): \DateTimeInterface
    {
        return $this->updateTime;
    }

    /**
     * @param \DateTimeInterface $updateTime
     * @return Snapshot
     */
    public function setUpdateTime(\DateTimeInterface $updateTime): Snapshot
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Snapshot
     */
    public function setVersion(string $version): Snapshot
    {
        $this->version = $version;
        return $this;
    }


}
