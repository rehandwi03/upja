<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSAdmin extends Model
{
    const CREATED_AT = 'admin_created';
    const UPDATED_AT = 'admin_updated';
    protected $table = 'ms_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['admin_username', 'admin_password', 'admin_fullname', 'admin_hide', 'id_role'];
}
