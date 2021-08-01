<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DistrictShippingCharge extends Model
{
    //
    protected $fillable = ['city_id', 'origin_id', 'destination_id', 'price'];

    public function district()
    {
      return $this->hasMany(District::class);
    }
}
