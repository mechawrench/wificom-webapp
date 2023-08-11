<?php

namespace App\Rules;

use App\Models\WifiDevice;
use Illuminate\Contracts\Validation\Rule;

class AlphaNumericNoSpaces implements Rule
{
    private $user_id;
    private $device_id;

    public function __construct($user_id, $device_id = null)
    {
        $this->user_id = $user_id;
        $this->device_id = $device_id;
    }

    public function passes($attribute, $value)
    {
        $device = $this->device_id ? WifiDevice::find($this->device_id) : null;

        // Check if value is alphanumeric for new records and existing conforming names
        if (!$device || ($device && preg_match('/^[a-zA-Z0-9]+$/', $device->device_name))) {
            if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) {
                return false;
            }
        }

        // Unique name check query
        $query = WifiDevice::where('user_id', $this->user_id)
            ->where('device_name', $value);

        // If device_id is set, we're updating an existing record, so exclude it from the query
        if ($this->device_id) {
            $query->where('id', '!=', $this->device_id);
        }

        // If a record exists that matches the device_name and user_id, the validation fails.
        return $query->count() == 0;
    }

    public function message()
    {
        return 'The :attribute may only contain alphanumeric characters and no spaces.';
    }
}
