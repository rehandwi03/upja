<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSBank extends Model
{
    const CREATED_AT = 'bank_created';
    const UPDATED_AT = 'bank_updated';
    protected $table = 'ms_bank';
    protected $primaryKey = 'id_bank';
    protected $guarded = [];
}
