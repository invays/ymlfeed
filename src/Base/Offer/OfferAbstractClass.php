<?php

namespace Invays\Ymlfeed\Base\Offer;

use Invays\Ymlfeed\Delivery\Delivery;

abstract class OfferAbstractClass implements OfferInterface
{
    private $id;
    private $type;
    private $available;
    private $custom_offer_attributes = [];
    private $name;
    private $description = [];
    private $vendor;
    private $vendor_code;
    private $url;
    private $price;
    private $old_price;
    private $category_id;
    private $currency_id;
    private $store;
    private $pickup;
    private $delivery;
    private $weight;
    private $dimensions;
    private $pictures = [];
    private $params = [];
    private $custom_tags = [];
    private $delivery_options = [];
    private $pickup_options = [];

    public function setId(string|int $id): object
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string|int
    {
        return $this->id;
    }

    public function setType(string $type): object
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setAvailable(bool $available): object
    {
        $this->available = $available;
        return $this;
    }

    public function getAvailable(): bool
    {
        return $this->available;
    }

    public function setCustomOfferAttributes(string $name, string $value): object
    {
        $this->custom_offer_attributes[$name] = $value;
        return $this;
    }

    public function getCustomOfferAttributes(): array
    {
        return $this->custom_offer_attributes;
    }

    public function setName(string $name): object
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description, bool $cdata): object
    {
        $this->description = [
            'text'  => $description,
            'cdata' => $cdata
        ];
        return $this;
    }

    public function getDescription(): array
    {
        return $this->description;
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

    public function setVendorCode(string $vendor_code): object
    {
        $this->vendor_code = $vendor_code;
        return $this;
    }

    public function getVendorCode(): string
    {
        return $this->vendor_code;
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

    public function setPrice(float|int $price): object
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): float|int
    {
        return $this->price;
    }

    public function setOldPrice(float|int $old_price): object
    {
        $this->old_price = $old_price;
        return $this;
    }

    public function getOldPrice(): float|int
    {
        return $this->old_price;
    }

    public function setCategoryId(int $category_id): object
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCurrencyId(string $currency_id): object
    {
        $this->currency_id = $currency_id;
        return $this;
    }

    public function getCurrencyId(): string
    {
        return $this->currency_id;
    }

    public function setStore(bool $store): object
    {
        $this->store = $store;
        return $this;
    }

    public function getStore(): bool
    {
        return $this->store;
    }

    public function setPickup(bool $pickup): object
    {
        $this->pickup = $pickup;
        return $this;
    }

    public function getPickup(): bool
    {
        return $this->pickup;
    }

    public function setDelivery(bool $delivery): object
    {
        $this->delivery = $delivery;
        return $this;
    }

    public function getDelivery(): bool
    {
        return $this->delivery;
    }

    public function setWeight(float|int $weight): object
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight(): float|null
    {
        return $this->weight;
    }

    public function setPictures(array $pictures): object
    {
        $this->pictures[] = $pictures;
        return $this;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setParams(string $name, string $value, array $custom_attributes): object
    {
        $this->params[] = [
            'name'              => $name,
            'value'             => $value,
            'custom_attributes' => $custom_attributes,
        ];

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setDimensions(float|int $length, float|int $width, float|int $height): object
    {
        $dimensions = [
            round((float) $length, 3),
            round((float) $width, 3),
            round((float) $height, 3),
        ];

        $this->dimensions = \implode('/', $dimensions);

        return $this;
    }

    public function getDimensions(): string|null
    {
        return $this->dimensions;
    }

    public function setDeliveryOptions(object $delivery_options): object
    {
        $this->delivery_options[] = $delivery_options;
        return $this;
    }

    public function getDeliveryOptions(): array
    {
        return $this->delivery_options;
    }

    public function setPickupOptions(object $pickup_options): object
    {
        $this->pickup_options[] = $pickup_options;
        return $this;
    }

    public function getPickupOptions(): array
    {
        return $this->pickup_options;
    }

    public function setCustomTags(object $custom_tags): object
    {
        $this->custom_tags[] = $custom_tags;
        return $this;
    }

    public function getCustomTags(): array
    {
        return $this->custom_tags;
    }




}
