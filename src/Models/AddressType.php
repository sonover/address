<?php

namespace Sonover\Address\Models;

use Konekt\Enum\Enum;
use Sonover\Address\Contracts\AddressType as AddressTypeContract;

class AddressType extends Enum implements AddressTypeContract {
    const __default = self::UNDEFINED;
    
    /** To display on Invoices */
    const BILLING = 'billing';
   
    /** At which a business is located */
    const BUSINESS = 'business';
    
    /** Aka legal address: that is the registered address of a person/organization */
    const CONTRACT = 'contract';
    
    /** To which (physical) correspondence should be sent */
    const MAILING = 'mailing';
    
    /** At which items should be picked up */
    const PICKUP = 'pickup';
    
    /** Where a person lives */
    const RESIDENTIAL = 'residential';
    
    /** To which ordered goods should be shipped */
    const SHIPPING = 'shipping';
    
     /** To which ordered goods should be delivered */
     const DELIVERY = 'delivery';

    /** Not specified */
    const UNDEFINED = null;
    
    protected static $labels = [];

    protected static function boot()
    {
        static::$labels = [
            self::BILLING     => __('Billing'),
            self::BUSINESS    => __('Business'),
            self::CONTRACT    => __('Contract'),
            self::MAILING     => __('Mailing'),
            self::PICKUP      => __('Pickup'),
            self::RESIDENTIAL => __('Residential'),
            self::SHIPPING    => __('Shipping'),
            self::DELIVERY    => __('Delivery'),
            self::UNDEFINED   => __('Undefined')
        ];
    }
}