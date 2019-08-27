<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'authme';
    protected $rememberTokenName = false;

    public static function byRank($rank) {
        $inheritances = DB::table('permissions_inheritance')
                        ->select('child')
                        ->where('parent', $rank)
                        ->where('type', 1)
                        ->get()->pluck('child');

        $permissions = Permission::where('permission', 'name')->whereIn('name', $inheritances)->get(['value']);

        return User::whereIn('username', $permissions)->get();
    }

    public static function pexInheritancesByParent($parent)
    {
        return ;
    }

    public static function pexInstanceByPexName($name)
    {
        return Permission::where('name', $name)->first();
    }

}
