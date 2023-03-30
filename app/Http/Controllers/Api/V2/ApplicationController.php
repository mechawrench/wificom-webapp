<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\LastOutputRequestV2;
use App\Http\Requests\SendDigiromRequestV2;
use App\Models\AppApiKey;
use App\Models\application;
use App\Models\WifiDevice;
use Log;

class ApplicationController extends Controller
{
    // TODO: Extract checks to middleware for repeated code
    public static function send_digirom(SendDigiromRequestV2 $request)
    {
        // Ensure user key is valid and matches the application
        $api_key = AppApiKey::where('api_key', $request->get('api_key'))->first();

        if (!$api_key) {
            \Log::error('Invalid API Key: ' . $request->get('api_key'));

            return response(['error' => 'Invalid API Key'], 401);
        }

        $application = Application::where('uuid', $request->get('application_uuid'))->first();

        if (!$application) {
            \Log::error('Invalid application UUID: ' . $request->get('application_uuid'));

            return response(['error' => 'Invalid application UUID'], 401);
        }

        if ($api_key->app_id != $application->id) {
            \Log::error('Invalid API Key: ' . $request->get('api_key') . ' for application: ' . $request->get('application_uuid'));

            return response(['error' => 'Invalid API Key for application'], 401);
        }

        if($api_key->paused) {
            \Log::error('API Key: ' . $request->get('api_key') . ' is paused for application: ' . $request->get('application_uuid'));

            return response(['error' => 'API Key is paused for application'], 401);
        }

        $device = WifiDevice::where('device_name', $request->get('device_name'))
                ->where('user_id', $api_key->user_id)
                ->first();

        if (!$device) {
            \Log::error('Invalid device name: ' . $request->get('device_name'));
            return response(['error' => 'Invalid device name'], 401);
        }

        if (!$application) {
            \Log::error('Invalid application UUID: ' . $request->get('application_uuid') . 'For user: ');

            return response(['error' => 'Invalid application UUID or not currently subscribed to the application.'], 401);
        }

        $device->last_output = null;
        $device->last_valid_output = null;
        $device->pending_digirom = $request->get('digirom');
        $device->last_code_sent_at = now();
        $device->save();

        $message_data = [
            'digirom' => $request->get('digirom'),
            'application_id' => $application->uuid,
            'hide_output' => $application->is_output_hidden,
            'api_response' => $application->is_output_hidden,
        ];

        // TODO: Make mqtt setup a function
        $mqtt = new \PhpMqtt\Client\MqttClient(config('mqtt-client.connections.default.host'), config('mqtt-client.connections.default.port'));

        $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
            ->setUsername(config('mqtt-client.connections.default.connection_settings.auth.username'))
            ->setPassword(config('mqtt-client.connections.default.connection_settings.auth.password'))
            ->setConnectTimeout(3)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true);

        $mqtt->connect($connectionSettings, true);
        $mqtt->publish($device->user->name . '/f/' . $device->user->uuid . '-' . $device->uuid . '/wificom-input', json_encode($message_data));

        \Log::info('Sent digirom to device: ' . $device->uuid . ' for application: ' . $application->app->name . ' for user: ' . $device->user->email);
        return response()->json(['device' => $device->only('uuid', 'device_name', 'pending_digirom', 'last_ping_at', 'last_used_at', 'last_code_sent_at')], 200);
    }

    public static function last_output(LastOutputRequestV2 $request)
    {
        // Ensure user key is valid and matches the application
        $api_key = AppApiKey::where('api_key', $request->get('api_key'))->first();

        if (!$api_key) {
            \Log::error('Invalid API Key: ' . $request->get('api_key'));

            return response(['error' => 'Invalid API Key'], 401);
        }

        $application = Application::where('uuid', $request->get('application_uuid'))->first();

        if (!$application) {
            \Log::error('Invalid application UUID: ' . $request->get('application_uuid'));

            return response(['error' => 'Invalid application UUID'], 401);
        }

        if ($api_key->app_id != $application->id) {
            \Log::error('Invalid API Key: ' . $request->get('api_key') . ' for application: ' . $request->get('application_uuid'));

            return response(['error' => 'Invalid API Key for application'], 401);
        }

        if($api_key->paused) {
            \Log::error('API Key: ' . $request->get('api_key') . ' is paused for application: ' . $request->get('application_uuid'));

            return response(['error' => 'API Key is paused for application'], 401);
        }

        $device = WifiDevice::where('device_name', $request->get('device_name'))
                ->where('user_id', $api_key->user_id)
                ->first();

        if (!$device) {
            \Log::error('Invalid device name: ' . $request->get('device_name'));
            return response(['error' => 'Invalid device UUID'], 401);
        }

        $device_clone = clone $device;

        // Set last_output to null
        $device->last_output = null;
        $device->save();

        // Get last output from cache
        $last_output = \Illuminate\Support\Facades\Cache::get($device->user->uuid . '-' . $device->uuid . '-' . $request->get('application_uuid') . '_last_output');

        if ($last_output) {
            $last_output_clone = clone $last_output;
        } else {
            $last_output_clone = $device_clone->last_output;
        }

        \Illuminate\Support\Facades\Cache::forget($device->user->uuid . '-' . $device->uuid . '-' . $request->get('application_uuid') . '_last_output');

        $return_data = [
            'last_output' => $device_clone->last_output,
            'last_code_sent_at' => $device->last_code_sent_at,
            'device' => $device_clone->only('uuid', 'device_name', 'last_ping_at', 'last_used_at', 'last_code_sent_at'),
        ];

        Log::info('Sent last output to application: ' . $application->name . ' for user: ' . $device->user->email, $return_data);
        return response()->json($return_data, 200);
    }
}
