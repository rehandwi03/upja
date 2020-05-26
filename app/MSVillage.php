<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSVillage extends Model
{
    const CREATED_AT = 'village_created';
    const UPDATED_AT = 'village_updated';
    protected $table = 'ms_village';
    protected $primaryKey = 'id_village';
    protected $guarded = [];
}
