<?php

namespace App\Models;

use App\Classes\Model;
use App\MagicTrait;

class Address extends Model
{
    use MagicTrait;
    const TABLE = 'address';

    public $id;
    public $address;
    public $zip_city;
    public $country_id;

    public function __get($key)
    {
        if($key = 'country' ) {
            $country = Country::findById((int)$this->country_id);
            return $country;
        } else {
            return null;
        }
    }

    public function __isset($key)
    {
        if($key = 'country' && !empty($this->country_id)) {
            return true;
        } else {
            return false;
        }
    }

}
