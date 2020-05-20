<?php

namespace App;

use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class MSAdmin extends Authenticatable
{
    use HasRoles;
    const CREATED_AT = 'admin_created';
    const UPDATED_AT = 'admin_updated';
    protected $table = 'ms_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['admin_username', 'admin_password', 'admin_fullname', 'admin_hide', 'id_role'];
}
