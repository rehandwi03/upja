<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSFarmer extends Model
{
    const CREATED_AT = 'farmer_created';
    const UPDATED_AT = 'farmer_updated';
    protected $guarded = [];
    protected $primaryKey = 'id_farmer';
    protected $table = 'ms_farmer';
}
