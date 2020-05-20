<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSRole extends Model
{
    const CREATED_AT = 'role_created';
    const UPDATED_AT = 'role_updated';
    protected $table = 'ms_role';
    protected $fillable = ['role_name', 'role_desc', 'role_created', 'role_updated'];
    protected $hidden = ['id'];
    protected $primaryKey = 'id_role';

    public function admin()
    {
        return $this->hasMany(MSAdmin::class, 'id_role');
    }
}
