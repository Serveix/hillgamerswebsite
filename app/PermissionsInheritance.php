<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsInheritance extends Model
{
    protected $table = 'permissions_inheritance';
    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vipUser()
    {
        return $this->hasOne('App\VipUser');
    }
}
