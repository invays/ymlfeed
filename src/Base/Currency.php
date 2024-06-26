<?php

namespace Invays\Ymlfeed\Base;

class Currency
{
    private $id;
    private $rate;

    public function toArray(): array
    {
        return [
            'id'   => $this->getId(),
            'rate' => $this->getRate(),
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate(float|int $rate): object
    {
        $this->rate = $rate;
        return $this;
    }
}
