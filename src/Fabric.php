<?php

namespace Invays\Ymlfeed;

use Invays\Ymlfeed\Setting;

/**
 * The Fabric class is responsible for generating a YML feed file for Yandex.Market.
 * It uses the XMLWriter class to write the XML structure of the feed, including the shop information, currencies, categories, delivery options, and product offers.
 * The class provides methods to add the header, footer, and various elements of the YML feed.
 */
class Fabric
{

    protected $feed_file;
    protected $writer;
    protected $setting;

    public function __construct($setting = null)
    {

        $this->setting = $setting instanceof Setting ? $setting : new Setting();
        $this->feed_file = $setting->getFeedFile();
        $this->writer = new \XMLWriter();
        $this->writer->openURI($this->feed_file);
    }

    /**
     * Generate XML file template for YML feed.
     *
     * @return void
     */
    public function run(object $shop, array $currencies, array $categories, array $offers): void
    {
        $this->addHeader();
        $this->addShop($shop);
        $this->addCurrencies($currencies);
        $this->addCategories($categories);
        $this->addOffers($offers);
        $this->addFooter();
    }

    public function run_test(): void
    {
        $this->addHeader();
    }

    protected function addHeader(): void
    {
        $this->writer->setIndent(true);
        $this->writer->setIndentString('  ');
        $this->writer->startDocument('1.0', $this->setting->getEncoding());
        $this->writer->startElement('yml_catalog');
        $this->writer->writeAttribute('date', \date(DATE_RFC3339));
        $this->writer->startElement('shop');
    }

    /**
     * Add document footer
     */
    protected function addFooter(): void
    {
        $this->writer->fullEndElement();
        $this->writer->endDocument();
    }

    protected function addShop(object $shop): void
    {
        foreach ($shop->toArray() as $name => $value) {
            if ($value !== null) {
                $this->writer->writeElement($name, $value);
            }
        }
    }

    protected function addCategories(array $categories): void
    {
        $this->writer->startElement('categories');

        foreach ($categories as $category) {
            $this->writer->startElement('category');

            $this->writer->writeAttribute('id', $category->getId());

            if ($category->getParentId() !== null) {
                if ($category->getParentId() !== 0) {
                    $this->writer->writeAttribute('parentId', $category->getParentId());
                }
            }

            if (!empty($category->getCustomAttributes())) {
                foreach ($category->getCustomAttributes() as $name => $value) {
                    $this->writer->writeAttribute($name, $value);
                }
            }

            $this->writer->text($category->getName());
            $this->writer->fullEndElement();
        }

        $this->writer->fullEndElement();
    }

    protected function addCurrencies(array $currencies): void
    {
        $this->writer->startElement('currencies');

        foreach ($currencies as $currency) {
            $this->writer->startElement('currency');
            $this->writer->writeAttribute('id', $currency->getId());
            $this->writer->writeAttribute('rate', $currency->getRate());
            $this->writer->endElement();
        }

        $this->writer->fullEndElement();
    }

    protected function addOffers(array $offers): void
    {
        try {
            $this->writer->startElement('offers');
            foreach ($offers as $offer) {
                $this->writer->startElement('offer');
                $this->writer->writeAttribute('id', $offer->getId());

                if ($offer->getCustomOfferAttributes()) {
                    foreach ($offer->getCustomOfferAttributes() as $name => $value) {
                        $this->writer->writeAttribute($name, $value);
                    }
                }

                // Name
                $this->writer->startElement('name');
                $this->writer->text($offer->getName());
                $this->writer->fullEndElement();

                // Description
                $this->writer->startElement('description');
                if ($offer->getDescription()['cdata'] == true) {
                    $this->writer->writeCData($offer->getDescription()['text']);
                } else {
                    $this->writer->text($offer->getDescription()['text']);
                }
                $this->writer->fullEndElement();

                // Url 
                $this->writer->startElement('url');
                $this->writer->text($offer->getUrl());
                $this->writer->fullEndElement();

                // store
                $this->writer->startElement('store');
                $this->writer->text($offer->getStore());
                $this->writer->fullEndElement();

                // pickup
                $this->writer->startElement('pickup');
                $this->writer->text($offer->getPickup());
                $this->writer->fullEndElement();

                // delivery
                $this->writer->startElement('delivery');
                $this->writer->text($offer->getDelivery());
                $this->writer->fullEndElement();

                // dimensions
                if ($offer->getDimensions() !== null) {
                    $this->writer->startElement('dimensions');
                    $this->writer->text($offer->getDimensions());
                    $this->writer->fullEndElement();
                }

                if ($offer->getParams()) {
                    $this->addParams($offer);
                }

                if ($offer->getDeliveryOptions()) {
                    $this->writer->startElement('delivery-options');
                    $this->addDeliveryOptions($offer);
                    $this->writer->fullEndElement();
                }

                if ($offer->getPickupOptions()) {
                    $this->writer->startElement('pickup-options');
                    $this->addDeliveryOptions($offer);
                    $this->writer->fullEndElement();
                }

                if ($offer->getCustomTags()) {
                    $this->addCustomTags($offer);
                }


                $this->writer->fullEndElement();
            }
            $this->writer->fullEndElement();

        } catch (\Exception $e) {
            throw new \Exception('Error in offers');
        }
    }

    private function addParams(object $offer): void
    {
        foreach ($offer->getParams() as $param) {
            $this->writer->startElement('param');
            $this->writer->writeAttribute('name', $param['name']);

            if ($param['custom_attributes']) {
                foreach ($param['custom_attributes'] as $name => $value) {
                    $this->writer->writeAttribute($name, $value);
                }
            }

            $this->writer->text($param['value']);
            $this->writer->fullEndElement();
        }
    }

    private function addDeliveryOptions(object $offer): void
    {
        foreach ($offer->getDeliveryOptions() as $delivery_option) {
            $this->writer->startElement('option');

            $this->writer->writeAttribute('cost', $delivery_option->getCost());

            if ($delivery_option->getDays() !== null) {
                $this->writer->writeAttribute('days', $delivery_option->getDays());
            }

            if ($delivery_option->getOrderBefore() !== null) {
                $this->writer->writeAttribute('order-before', $delivery_option->getOrderBefore());
            }

            $this->writer->endElement();
        }
    }

    private function addPickupOptions(object $offer): void
    {
        foreach ($offer->getPickupOptions() as $pickup_options) {
            $this->writer->startElement('option');

            $this->writer->writeAttribute('cost', $pickup_options->getCost());

            if ($pickup_options->getDays() !== null) {
                $this->writer->writeAttribute('days', $pickup_options->getDays());
            }

            if ($pickup_options->getOrderBefore() !== null) {
                $this->writer->writeAttribute('order-before', $pickup_options->getOrderBefore());
            }

            $this->writer->endElement();
        }

    }

    private function addCustomTags(object $offer): void
    {
        foreach ($offer->getCustomTags() as $tag) {
            $this->writer->startElement($tag->getName());

            if ($tag->getCustomAttributes()) {
                foreach ($tag->getCustomAttributes() as $name => $value) {
                    $this->writer->writeAttribute($name, $value);
                }
            }

            if ($tag->getValue() !== null) {
                $this->writer->text($tag->getValue());
            } else {
                if ($tag->getCustomOptions()) {
                    foreach ($tag->getCustomOptions() as $option) {
                        $this->writer->startElement($option->getName());

                        if ($option->getCustomAttributes()) {
                            foreach ($option->getCustomAttributes() as $name => $value) {
                                $this->writer->writeAttribute($name, $value);
                            }
                        }

                        if ($option->getValue() !== null) {
                            $this->writer->text($option->getValue());
                            $this->writer->fullEndElement();
                        } else {
                            $this->writer->endElement();
                        }
                    }
                }
            }

            $this->writer->endElement();
        }
    }


}
