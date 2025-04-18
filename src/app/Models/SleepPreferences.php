<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepPreferences extends Model
{
    /** @use HasFactory<\Database\Factories\SleepPreferencesFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'fall_asleep_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
