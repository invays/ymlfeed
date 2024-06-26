<?php

namespace Invays\Ymlfeed\Base;

class Category
{
    private $name;
    private $parent_id = null;
    private $id;

    private $custom_attributes = [];

    public function toArray(): array
    {
        $data = [
            'name'       => $this->getName(),
            'attributes' => [
                'id'        => $this->getId(),
                'parent_id' => $this->getParentId(),
            ]
        ];

        foreach ($this->custom_attributes as $name => $value) {
            $data['attributes'][$name] = $value;
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

    public function getParentId(): int|null
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): object
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): object
    {
        $this->id = $id;
        return $this;
    }

    public function setCustomAttributes(string $name, string|int|float $value): object
    {
        $this->custom_attributes[$name] = $value;
        return $this;
    }

    public function getCustomAttributes(): array
    {
        return $this->custom_attributes;
    }


}
