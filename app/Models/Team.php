<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\League;
use App\Player;

class Team extends Model
{
    public function league()
    {
        return $this->belongsToMany(League::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
