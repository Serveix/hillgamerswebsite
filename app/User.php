<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * @var string
     */
    protected $table = 'authme';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    protected $rememberTokenName = false;

    const VIP_RANK = 'VIP';

    /**
     * @param $rank
     * @return mixed
     */
    public static function byRank($rank)
    {
        $playersUsernames = LuckpermsPlayer::where('primary_group', $rank)->get(['username']);

        return User::whereIn('username', $playersUsernames)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vipUser() {
        return $this->hasOne('App\VipUser', 'user_id');
    }

    public function isVip()
    {
        return $this->subscribed(env('STRIPE_MAIN_SUB'));
    }

}
