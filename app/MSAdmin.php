<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MSAdmin extends Model
{
    const CREATED_AT = 'admin_created';
    const UPDATED_AT = 'admin_updated';
    protected $table = 'ms_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['admin_username', 'admin_password', 'admin_fullname', 'admin_hide', 'id_role'];
    protected $hidden = ['admin_password'];

    public function role()
    {
        return $this->BelongsTo(MSRole::class, 'id_role');
    }
}
