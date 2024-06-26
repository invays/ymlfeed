<?php

namespace Invays\Ymlfeed\Base;

class Shop
{
    private $name;
    private $company;
    private $url;
    private $platform;
    private $custom_tags = [];

    public function toArray(): array
    {
        $data = [
            'name'     => $this->getName(),
            'company'  => $this->getCompany(),
            'url'      => $this->getUrl(),
            'platform' => $this->getPlatform(),
        ];

        foreach ($this->getCustomTags() as $name => $value) {
            $data[$name] = $value;
        }

        return $data;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): object
    {
        $this->name = $name;
        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): object
    {
        $this->company = $company;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): object
    {
        $this->url = $url;
        return $this;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): object
    {
        $this->platform = $platform;
        return $this;
    }

    public function setCustomTag(string $tag, string|int|float $value): object
    {
        $this->custom_tags[$tag] = $value;
        return $this;
    }

    public function getCustomTags(): array
    {
        return $this->custom_tags;
    }


}
