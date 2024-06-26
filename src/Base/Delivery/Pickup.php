<?php
namespace Invays\Ymlfeed\Base\Delivery;

class Pickup
{
    private $cost;
    private $days;
    private $order_before;

    public function setCost(int $cost): object
    {
        $this->cost = $cost;
        return $this;
    }
    public function getCost(): int
    {
        return $this->cost;
    }

    public function setDays(string|null $days): object
    {
        $this->days = $days;
        return $this;
    }

    public function getDays(): string|null
    {
        return $this->days;
    }

    public function setOrderBefore(string|null $order_before): object
    {
        $this->order_before = $order_before;
        return $this;
    }


    public function getOrderBefore(): string|null
    {
        return $this->order_before;
    }

}
