<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerAddress extends Model
{
    public $timestamps = false;
    protected $table = 'farmer_address';
    protected $primaryKey = 'id_faddress';
    protected $guarded = [];
}
