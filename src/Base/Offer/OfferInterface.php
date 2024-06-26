<?php

namespace Invays\Ymlfeed\Base\Offer;


/**
 * Abstract Class Offer
 */
interface OfferInterface
{
    public function getId();
    public function getType();
    public function getAvailable();
    public function getName();

}
