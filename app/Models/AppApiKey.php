<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class AppApiKey extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateUniqueKey($application_id)
    {
        $englishWords = [
            'apple', 'bathe', 'chair', 'drain', 'elope', 'flute', 'globe', 'haste', 'inbox', 'joust',
            'knave', 'lemur', 'motel', 'nudge', 'oasis', 'patio', 'quilt', 'raven', 'swipe', 'table',
            'urban', 'vague', 'whale', 'xenon', 'yield', 'zebra', 'actor', 'badge', 'crust', 'dwell',
            'ethos', 'froth', 'gloat', 'hoist', 'ivory', 'jolly', 'kneel', 'lurch', 'mince', 'nymph',
            'organ', 'pride', 'queue', 'roast', 'sloth', 'towel', 'unity', 'vivid', 'waste', 'xerox',
            'yacht', 'zippy', 'amber', 'bluff', 'creep', 'douse', 'elbow', 'faint', 'grasp', 'hover',
            'input', 'jaded', 'kiosk', 'laugh', 'mirth', 'noble', 'olive', 'plume', 'quark', 'rifle',
            'siren', 'toxic', 'udder', 'vixen', 'woven', 'xylem', 'yodel', 'zesty', 'acorn', 'blend',
            'clove', 'drove', 'eject', 'flock', 'gnarl', 'hutch', 'irate', 'jumbo'
        ];

        $faker = Faker::create('en_US');
        $unique = false;
        while (!$unique) {
            $key = $faker->randomElement($englishWords) . '-' . $faker->randomElement($englishWords) . '-' . $faker->randomElement($englishWords);

            // Check if the key exists in the database
            if (!AppApiKey::where('api_key', $key)->exists()) {
                $unique = true;
            }
        }

        // Check if an existing AppApiKey record is found for the user and app ID
        $appApiKey = auth()->user()->appApiKeys()->where('app_id', $application_id)->first();

        if ($appApiKey) {
            // Update the existing record with the new key
            $appApiKey->update(['api_key' => $key]);
            $appApiKey->save();
        } else {
            // Create a new record and associate it with the user and app ID
            $appApiKey = new AppApiKey([
                'api_key' => $key,
                'app_id' => $application_id,
                'last_rotated_at' => \Carbon\Carbon::now(),
            ]);
            auth()->user()->appApiKeys()->save($appApiKey);
        }

        return $key;
    }
}
