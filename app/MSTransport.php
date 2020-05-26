<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSTransport extends Model
{
    const CREATED_AT = 'transport_created';
    const UPDATED_AT = 'transport_updated';
    protected $table = 'ms_transport';
    protected $primaryKey = 'id_transport';
    protected $guarded = [];
}
