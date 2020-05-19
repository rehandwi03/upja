<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSUpja extends Model
{
    const CREATED_AT = 'upja_created';
    const UPDATED_AT = 'upja_updated';
    protected $table = 'ms_upja';
    protected $primaryKey = 'id_upja';
    protected $guarded = [];
}
