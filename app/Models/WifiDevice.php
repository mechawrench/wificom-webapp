<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiDevice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($device) {
            $device->uuid = hexdec(uniqid());
            if (! $device->user_id) {
                $device->user_id = auth()->id();
            }
        });

        static::created(function ($wifi_device) {

            // Create ACL for user
            $wifi_device->user->mqtt_acl()->create([
                'user_id' => $wifi_device->user->id,
                'topic' => $wifi_device->user->name.'/f/'.$wifi_device->user->uuid.'-'.$wifi_device->uuid.'/#',
                'rw' => 4,
            ]);
        });
    }

    // Add casts
    protected $casts = [
        'last_ping_at' => 'datetime',
        'last_used_at' => 'datetime',
        'last_code_sent_at' => 'datetime',
        'last_output_web_updated_at' => 'datetime',
    ];

    protected $appends = [
        'online_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscribedApplications()
    {
        // Return hasMany using user_id field
        return $this->hasMany(SubscribedApplication::class, 'user_id', 'user_id');
    }

    public function getOnlineStatusAttribute()
    {
        return $this->last_ping_at > now()->subMinutes(1);
    }
}