<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'authme';

    /**
     * @var bool
     */
    protected $rememberTokenName = false;

    const VIP_RANK = 'VIP';

    /**
     * @param $rank
     * @return mixed
     */
    public static function byRank($rank) {
        // get all users who have the rank parameter
        $inheritances = DB::table('permissions_inheritance')
                        ->select('child')
                        ->where('parent', $rank)
                        ->where('type', 1)
                        ->get()->pluck('child');

        // get permissions table instance
        $permissions = Permission::where('permission', 'name')->whereIn('name', $inheritances)->get(['value']);

        return User::whereIn('username', $permissions)->get();
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function pexInstanceByPexName($name)
    {
        return Permission::where('name', $name)->first();
    }

    /**
     * @return mixed
     */
    public function pexInheritance() {
        $permission = Permission::where('permission', 'name')->where('type', 1)->where('value', $this->realname)->first();
        return PermissionsInheritance::where('child', $permission->name)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vipUser() {
        return $this->hasOne('App\VipUser', 'user_id');
    }

    public function isVip()
    {
        return $this->vipUser ? $this->vipUser->is_vip : false;
    }

}
