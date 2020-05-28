<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpjaUom extends Model
{
    const CREATED_AT = 'uom_created';
    const UPDATED_AT = 'uom_updated';
    protected $table = 'upja_uom';
    protected $primaryKey = 'id_uom';
    protected $guarded = [];
}
