<?php
namespace Invays\Ymlfeed\Base;

class Sets
{
    private $name;
    private $id;
    private $url;

    public function setName(string $name): object
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int|string $id): object
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    public function setUrl(string $url): object
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }


}
