<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransJourney extends Model
{
    public $timestamps = false;
    protected $table = 'trans_journey';
    protected $primaryKey = 'id_tjourney';
    protected $guarded = [];
}
