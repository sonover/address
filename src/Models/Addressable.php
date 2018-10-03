<?php

namespace Sonover\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Sonover\Address\Models\AddressTypeProxy;
use Sonover\Address\Contracts\Address as AddressContract;


trait Addressable {

    public function addresses() {
        return $this->morphMany(AddressProxy::modelClass(), 'addressable');
    }

    public function addAddress($data, $type = null) {
        if($data instanceof Model){
            $data = $data->toArray();
        }
        $data['type'] = is_null($type) ? AddressTypeProxy::defaultValue() : $type;
        return  $this->addresses()->create($data);
    }

    /** @test */
    public function clone_an_address() {

        $customer = Customer::create(['name' => 'Sonover Inc.']);
        $billing = $customer->addAddress([
            'address' => 'Spring',
            'province' => 'St. George',
            'country' => 'GD'
        ], 'billing');

        $shipping = $customer->addAddress($billing, 'shipping');

        tap($customer->fresh(), function($customer) use ($shipping, $billing) {
            $this->assertTrue($customer->billingAddress->contains($billing));
            $this->assertTrue($customer->shippingAddress->contains($shipping));
        });
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