<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSTrans extends Model
{
    const CREATED_AT = 'trans_created';
    const UPDATED_AT = 'trans_updated';
    protected $table = 'ms_trans';
    protected $primaryKey = 'id_trans';
    protected $guarded = [];
}
