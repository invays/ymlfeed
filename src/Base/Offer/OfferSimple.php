<?php
namespace Invays\Ymlfeed\Base\Offer;

use Invays\Ymlfeed\Base\Offer\OfferAbstractClass;

class OfferSimple extends OfferAbstractClass
{
    private $name;
    private $vendor;
    private $vendorCode;

    public function setName(string $name): object
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setVendor(string $vendor): object
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    public function setVendorCode(string $vendorCode): object
    {
        $this->vendorCode = $vendorCode;
        return $this;
    }

    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }

}