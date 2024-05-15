<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class League extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    protected $fillable = [
        'name', 'init_date', 'end_date', 'n_of_dates'
    ];
}
