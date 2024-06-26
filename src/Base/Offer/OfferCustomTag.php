<?php
namespace Invays\Ymlfeed\Base\Offer;

class OfferCustomTag
{
    private $name;
    private $value;
    private $custom_attributes = [];
    private $custom_options = [];

    public function setName(string $name): object
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setValue(string|float|int|null $value): object
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): string|float|int|null
    {
        return $this->value;
    }

    public function setCustomAttributes(string $name, string|float|int|null $value): object
    {
        $this->custom_attributes[$name] = $value;
        return $this;
    }

    public function getCustomAttributes(): array
    {
        return $this->custom_attributes;
    }

    public function setCustomOptions(object $option): object
    {
        $this->custom_options[] = $option;
        return $this;
    }

    public function getCustomOptions(): array
    {
        return $this->custom_options;
    }

}
