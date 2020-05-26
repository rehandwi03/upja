<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSSubdistrict extends Model
{
    const CREATED_AT = 'subdistrict_created';
    const UPDATED_AT = 'subdistrict_updated';
    protected $table = 'ms_subdistrict';
    protected $guarded = [];
    protected $primaryKey = 'id_subdistrict';
}
