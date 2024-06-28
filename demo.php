<?php
require './vendor/autoload.php';

use Invays\Ymlfeed\Base\Delivery\Pickup;
use Invays\Ymlfeed\Setting;
use Invays\Ymlfeed\Fabric;
use Invays\Ymlfeed\Base\Shop;
use Invays\Ymlfeed\Base\Category;
use Invays\Ymlfeed\Base\Currency;
use Invays\Ymlfeed\Base\Sets;
use Invays\Ymlfeed\Base\Delivery\Delivery;
use Invays\Ymlfeed\Base\Offer\OfferCustomTag;
use Invays\Ymlfeed\Base\Offer\OfferSimple;
use Invays\Ymlfeed\Base\Offer\OfferAuto;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Demo
{
    public function run()
    {
        $setting = (new Setting())
            ->setOutputFile('./test.xml')
            ->setEncoding('UTF-8')
        ;

        $shop = (new Shop())
            ->setCompany('Invays LLC')
            ->setName('ANDRONICS')
            ->setUrl('https://invays.com')
            ->setPlatform('Magento')
            ->setCustomTag('email', 'my_email@gmail.com')
            ->setCustomTag('custom_tag2', 'custom_value2')
        ;

        $currencies[] = (new Currency())
            ->setId('USD')
            ->setRate(1)
        ;

        $categories[] = (new Category())
            ->setName('Category 1')
            ->setId(1)
            ->setCustomAttributes('my_custom_category_tag', 123)
        ;

        $categories[] = (new Category())
            ->setName('Category 2')
            ->setId(2)
            ->setParentId(1)
            ->setCustomAttributes('bid', 233)
            ->setCustomAttributes('cid', 233)
        ;

        $sets[] = (new Sets())
            ->setId('s1')
            ->setUrl('http://my_url')
            ->setName('Set 1');


        $offers[] = (new OfferAuto())
            ->setId(2)
            ->setType('simplefff')
            ->setAvailable(false)
            ->setCustomOfferAttributes('myTag', 'Bne') // custom_attribute for offers
            ->setCustomOfferAttributes('myTagF', 'BFF')
            ->setName('Simple Offer 1')
            ->setDescription('Simple Offer 1 Description', true)
            ->setVendor('Invays LLC')
            ->setVendorCode('werwer')
            ->setUrl('https://invays.com')
            ->setPrice(100)
            ->setOldPrice(100)
            ->setCategoryId(1)
            ->setCurrencyId('USD')
            ->setStore(true)
            ->setPickup(true)
            ->setDelivery(true)
            ->setPictures([
                'https://invays.com/1.jpg',
                'https://invays.com/2.jpg',
                'https://invays.com/3.jpg',
            ])
            ->setParams('param1', 'value1', ['custom_attribute1' => 'custom_value1'])
            ->setParams('param2', 'value2', ['unit' => 'Cm'])
            ->setParams('param3', 'value3', ['unit' => 'Cm'])
            ->setDimensions(20.3, '20', '20')
            ->setDeliveryOptions(
                (new Delivery())
                    ->setCost(100)
                    ->setDays('3-5')
                    ->setOrderBefore('1-2')
            )
            ->setDeliveryOptions(
                (new Delivery())
                    ->setCost(200)
                    ->setDays('3-5')
                    ->setOrderBefore('12')
            )
            ->setPickupOptions(
                (new Pickup())
                    ->setCost(200)
                    ->setDays('3-5')
                    ->setOrderBefore('12')
            )
            ->setCustomTags(
                (new OfferCustomTag())
                    ->setName('myTag')
                    //->setValue('myValue')
                    ->setCustomAttributes('myTagF', 'BFF')
                    ->setCustomOptions(
                        (new OfferCustomTag())
                            ->setName('myTagF')
                            ->setValue('BFF')
                    )
                    ->setCustomOptions(
                        (new OfferCustomTag())
                            ->setName('FFF')
                            ->setValue('ffffff')
                            ->setCustomAttributes('FFF', 'FFF')
                    )
            )
        ;


        (new Fabric($setting))->run(
            $shop,
            $currencies,
            $categories,
            $offers,
            $sets
        );

    }



}

$test = new Demo();
$test->run();
