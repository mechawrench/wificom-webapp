<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use JeffGreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $uuid = Str::uuid();
            $application->uuid = hexdec(uniqid());
            // name but remove spaces
            $application->name = str_replace(' ', '', strtolower($application->name));
            $application->mqtt_token = $uuid;
            $application->mqtt_token_hashed = Hash::make($uuid);
        });

        static::created(function ($application) {
            // Create ACL for user
            $application->mqtt_acl()->create([
                'user_id' => $application->id,
                'topic' => $application->name.'/'.$application->uuid.'/#',
                'rw' => 4,
            ]);
        });

        static::updating(function ($application) {
            if ($application->name != 'admin') {
                foreach ($application->mqtt_acl()->get() as $acl) {
                    // Extract name from topic
                    $name = explode('/', $acl->topic)[0];
                    $acl->topic = str_replace($name, $application->name, $acl->topic);
                    $acl->save();
                }
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        // 'wifiDeviceUuids'
    ];

    protected $attributes = [
        // 'wifiDeviceUuids',
    ];

    public function canAccessFilament(): bool
    {
        // TODO: Add email verification check
        // return $this->hasVerifiedEmail()

        return true; // Allow all users
    }

    public function wifiDevices()
    {
        // Retur a relationship to the wifi devices that this user has access to
        return $this->hasMany('App\Models\WifiDevice', 'user_id', 'id');
    }

    // Extract device_uuids from wifiDevices relationship into an attribute
    public function getWifiDeviceUuidsAttribute()
    {
        $wifiDevices = $this->hasMany('App\Models\WifiDevice', 'user_id', 'id')->get();
//        dd($wifiDevices);
        $device_uuids = [];
        foreach ($wifiDevices as $wifiDevice) {
            $device_uuids[] = $wifiDevice->uuid;
        }

        return $device_uuids;
    }

    public function mqtt_acl()
    {
        return $this->hasMany('App\Models\MqttAcl', 'user_id', 'id');
    }
}
