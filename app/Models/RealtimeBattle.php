<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RealtimeBattle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($realtimeBattle) {
            $realtimeBattle->uuid = hexdec(uniqid());
            // if $realtimeBattle has key invite_code, then use it as invite_code
            if (array_key_exists('invite_code', $realtimeBattle->toArray())) {
                $realtimeBattle->invite_code = $realtimeBattle->invite_code;
            } else {
                $realtimeBattle->invite_code = self::invite_code();
            }
            if (! $realtimeBattle->user_id) {
                $realtimeBattle->user_id = auth()->id();
            }
            $realtimeBattle->topic = $realtimeBattle->uuid.'/realtime-battle';
        });
    }

    public static function invite_code($code = null)
    {
        if (! $code) {
            $code = Str::random(6);
        }

        $check = RealtimeBattle::where('invite_code', $code)->first();

        if ($check) {
            return RealtimeBattle::invite_code();
        }

        return $code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
