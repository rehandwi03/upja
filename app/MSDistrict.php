<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSDistrict extends Model
{
    const CREATED_AT = 'district_created';
    const UPDATED_AT = 'district_updated';
    protected $table = 'ms_district';
    protected $primaryKey = 'id_district';
    protected $guarded = [];
}
