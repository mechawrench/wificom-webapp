<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PingRequest;
use App\Models\WifiDevice;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // TODO: Check that APIKey has proper permissions in these methods
    // TODO: Extract checks to middleware for repeated code

    public static function ping(PingRequest $request)
    {
        $device = WifiDevice::where('uuid', $request->get('device_uuid'))->first();

        if (! $device) {
            return response(['error' => 'Invalid device UUID'], 401);
        }

        $last_valid_output = null;

        // If request->get('last_output') length greater than 27 then true
        if (strlen($request->get('last_output')) > 27) {
            $last_valid_output = $request->get('last_output');
        }

        // FirstOrCreate() will create a new record if one does not exist.
        $device = WifiDevice::firstOrNew([
            'uuid' => $request->get('device_uuid'),
        ]);

        // Clone record to use values before modifications
        $device_clone = clone $device;

        $pending_digirom = $device->pending_digirom;

        $device->local_ip_address = $request->get('local_ip_address');
        $device->remote_ip_address = $request->ip();
        if ($request->get('last_output') != 'None') {
            $device->last_output = $request->get('last_output') ? $request->get('last_output') : $device->last_output;
        }
        $device->last_ping_at = now();
        $device->last_used_at = now(); // TODO: Move this to send_digirom method?

        if ($last_valid_output) {
            $device->last_valid_output = $last_valid_output;
        }

        // Erase pending DigiRom if it is not empty
        if ($pending_digirom) {
            $device->pending_digirom = null;
            $device->last_code_sent_at = now();
        }

        $device->save();

        return response()->json([
            'device' => $device->only(['uuid', 'device_name', 'last_output', 'last_valid_output', 'last_ping_at']), //local_ip_address
            'pending_digirom' => $device_clone->pending_digirom,
        ], 200);
    }
}
