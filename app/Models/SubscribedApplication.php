<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribedApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function app()
    {
        return $this->belongsTo(Application::class, 'application_uuid', 'uuid');
    }

    public function makeExclusive()
    {
        $this->setAllNonExclusive();

        $this->is_exclusive = true;
        $this->save();

        return $this;
    }

    public function makeNotExclusive()
    {
        $this->setAllNonExclusive();

        $this->is_exclusive = false;
        $this->save();

        return $this;
    }

    public function setAllNonExclusive()
    {
        $this->where('user_id', auth()->id())
            ->update(['is_exclusive' => false]);

        return $this;
    }
}
