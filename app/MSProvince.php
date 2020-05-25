<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSProvince extends Model
{
    const CREATED_AT = 'province_created';
    const UPDATED_AT = 'province_updated';
    protected $table = 'ms_province';
    protected $primaryKey = 'id_province';
    protected $guarded = [];
}
