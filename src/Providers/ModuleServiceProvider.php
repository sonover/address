<?php

namespace Sonover\Address\Providers;

use Sonover\Address\Models\Address;
use Sonover\Address\Models\AddressType;
use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Address::class
    ];

    protected $enums = [
        AddressType::class
    ];

}
