<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $application->uuid = hexdec(uniqid());
            if (!$application->user_id) {
                $application->user_id = auth()->id();
            }
            $application->slug = \Str::slug($application->name);
        });
    }

    protected $casts = [
        'is_public' => 'boolean',
        'is_output_hidden' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // hasone relationship where belongs to auth()->user()
    public function subscribed()
    {
        return $this->hasOne(SubscribedApplication::class, 'application_uuid', 'uuid')
            ->where('user_id', auth()->id());
    }

    public function subscribedV2()
    {
        return $this->hasOne(AppApiKey::class, 'app_id', 'id')
            ->where('user_id', auth()->user()->id);
    }

    public function subscribers()
    {
        return $this->hasMany(SubscribedApplication::class, 'application_uuid', 'uuid');
    }
}
