<?php
namespace Invays\Ymlfeed\Base\Offer;

use Invays\Ymlfeed\Base\Offer\OfferAbstractClass;

class OfferAuto extends OfferAbstractClass
{
    private $set_ids;

    public function setSet(array $set_ids): object
    {
        $this->set_ids = $set_ids;
        return $this;
    }

    public function getSet(): int
    {
        return $this->set_ids;
    }

}