<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dragon_life',
        'finished_at',
        'player_life',
        'started_at',
    ];

    protected $appends = [
        'formatted_started_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
    ];

    public function getFormattedStartedAtAttribute()
    {
        return Carbon::parse($this->started_at)->diffForHumans();
    }

    /**
     * Get the user that owns the game.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the logs for the game.
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
