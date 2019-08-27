<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipUser extends Model
{
    protected $fillable = [
        'user_id',
        'permissions_inheritance_id',
        'is_vip',
        'expiration_date',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pexInheritance() {
        return $this->belongsTo('App\PermissionsInheritance', 'permissions_inheritance_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
