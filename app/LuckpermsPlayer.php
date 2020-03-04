<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuckpermsPlayer extends Model
{
    protected $primaryKey = 'uuid';
    public $timestamps = false;
    protected $casts = [
        'uuid' => 'string'
    ];
}
