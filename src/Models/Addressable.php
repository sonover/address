<?php

namespace Sonover\Address\Models;

use Sonover\Address\Contracts\Address as AddressContract;
use Sonover\Address\Models\AddressTypeProxy;


trait Addressable {

    public function addresses() {
        return $this->morphMany(AddressProxy::modelClass(), 'addressable');
    }

    public function addAddress($data, $type = AddressTypeProxy::__default) {
        $data['type'] = isset($data['type']) ? $data['type'] : $type;
        return  $this->addresses()->create($data);
    }

    /**
     * Remove an address
     *
     * @param null $type
     * @return bool
     */
    public function removeAddress(AddressContract $address)
    {
        return $address->delete();
    }

    public function __get($property) {
        if(str_contains($property, 'Address')) {
            return $this->addresses()->byType(str_replace('Address', '', $property))->get();
        }

        return parent::__get($property);
    }
}