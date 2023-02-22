<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetSubscribersRequest;
use App\Http\Requests\LastOutputRequest;
use App\Http\Requests\SendDigiromRequest;
use App\Models\SubscribedApplication;
use App\Models\WifiDevice;
use PhpMqtt\Client\Facades\MQTT;
use Log;

class ApplicationController extends Controller
{
    // TODO: Extract checks to middleware for repeated code
    public static function send_digirom(SendDigiromRequest $request)
    {
        $device = WifiDevice::where('uuid', $request->get('device_uuid'))->first();

        if (!$device) {
            \Log::error('Invalid device UUID: ' . $request->get('device_uuid') . 'For user: ' . auth()->user()->email);
            return response(['error' => 'Invalid device UUID'], 401);
        }

        $subscribedApplication = $device->subscribedApplications()
            ->where('application_uuid', $request->get('application_uuid'))
            ->first();

        if (!$subscribedApplication) {
            \Log::error('Invalid application UUID: ' . $request->get('application_uuid') . 'For user: ' . auth()->user()->email);

            return response(['error' => 'Invalid application UUID or not currently subscribed to the application.'], 401);
        }

        // Check that $subscribedApplication->user_id == auth()->user()->id or that user is 3rd party authorized
        // TODO: Remove third_party_enabled from applications table now that we're using 3rd party proxy only
        // if ($subscribedApplication->user_id != auth()->user()->id) {
        //     \Log::error('You are not the application owner, can\'t perform that action. For user: '.auth()->user()->email);

        //     return response(['error' => 'You are not the API Key owner, can\'t perform that action.'], 401);
        // }

        // Find the first exclusive SubscribedApplication
        $exclusive_subscribedApplication = $device->subscribedApplications()
            ->where('is_exclusive', true)
            ->first();

        if ($exclusive_subscribedApplication && $exclusive_subscribedApplication->uuid != $subscribedApplication->uuid) {
            // TODO: Add device_id exclusives instead of account wide
            \Log::error('Another application is currently exclusive assigned to the user. For user: ' . auth()->user()->email . ' For application: ' . $subscribedApplication->app->name);
            return response(['error' => 'Another application is currently exclusive assigned to the user.'], 401);
        }

        $device->last_output = null;
        $device->last_valid_output = null;
        $device->pending_digirom = $request->get('digirom');
        $device->last_code_sent_at = now();
        $device->save();

        // Check for third party API Key usage
        //        $is_third_party = false;
        //        if (auth()->user()->id != $subscribedApplication->app->user_id && $subscribedApplication->app->is_third_party_enabled) {
        //            $is_third_party = true;
        //        }

        $message_data = [
            'digirom' => $request->get('digirom'),
            'application_id' => $subscribedApplication->app->uuid,
            'hide_output' => $subscribedApplication->app->is_output_hidden,
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

        Log::info('Sent digirom to device: ' . $device->uuid . ' for application: ' . $subscribedApplication->app->name . ' for user: ' . $device->user->email);
        return response()->json(['device' => $device->only('uuid', 'device_name', 'pending_digirom', 'last_ping_at', 'last_used_at', 'last_code_sent_at')], 200);
    }

    public static function last_output(LastOutputRequest $request)
    {
        $device = WifiDevice::where('uuid', $request->get('device_uuid'))->first();

        if (!$device) {
            \Log::error('No device found for UUID: ' . $request->get('device_uuid'));
            return response(['error' => 'Invalid device UUID'], 401);
        }

        $subscribedApplication = $device->subscribedApplications()->where('application_uuid', $request->get('application_uuid'))->first();

        if (!$subscribedApplication) {
            \Log::error('Invalid application UUID: ' . $request->get('application_uuid') . ' User: ' . auth()->user()->email);

            return response(['error' => 'Invalid application UUID or not currently subscribed to the application.'], 401);
        }

        // Check that $subscribedApplication->user_id == auth()->user()->id
        // if ($subscribedApplication->app->user_id != auth()->user()->id) {
        //     \Log::error('You are not the application owner, can\'t perform that action. For user: '.auth()->user()->email);
        //     return response(['error' => 'You are not the application owner, can\'t perform that action.'], 401);
        // }

        // Find the first exclusive SubscribedApplication
        $exclusive_subscribedApplication = $device->subscribedApplications()
            ->where('is_exclusive', true)
            ->first();

        if ($exclusive_subscribedApplication && $exclusive_subscribedApplication->uuid != $subscribedApplication->uuid) {
            // TODO: Add device_id exclusives instead of account wide
            Log::error('Another application is currently exclusive assigned to the user. For user: ' . auth()->user()->email . ' For application: ' . $subscribedApplication->app->name);
            return response(['error' => 'Another application is currently exclusive assigned to the user.'], 401);
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
            //'last_output' => $last_output_clone ? $last_output_clone : $device_clone->last_output,
            'last_output' => $device_clone->last_output,
            //'last_valid_output' => $device->last_valid_output,
            'last_code_sent_at' => $device->last_code_sent_at,
            'device' => $device_clone->only('uuid', 'device_name', 'last_ping_at', 'last_used_at', 'last_code_sent_at'),
        ];

        Log::info('Sent last output to application: ' . $subscribedApplication->app->name . ' for user: ' . $device->user->email, $return_data);
        return response()->json($return_data, 200);
    }

    public static function get_subscribers(GetSubscribersRequest $request)
    {
        $application = \App\Models\Application::where('uuid', $request->get('application_uuid'))
            ->with('subscribers')
            ->with('subscribers.user')
            ->select('uuid', 'user_id', 'name')
            ->first();

        if (!$application) {
            return response(['error' => 'Invalid application UUID or not currently subscribed to the application.'], 401);
        }

        if ($application->user_id != auth()->user()->id) {
            return response(['error' => 'You are not the application owner, can\'t perform that action.'], 401);
        }

        $subscribers = $application->subscribers->map(function ($subscriber) {
            return $subscriber->user->only('uuid', 'name', 'wifiDeviceUuids');
        });

        return response()->json($subscribers, 200);
    }

    public static function get_subscriber(GetSubscribersRequest $request, $subscriber_uuid)
    {
        $application = \App\Models\Application::where('uuid', $request->get('application_uuid'))
            ->with('subscribers')
            ->with('subscribers.user')
            ->select('uuid', 'user_id', 'name')
            ->first();

        if (!$application) {
            return response(['error' => 'Invalid application UUID.'], 404);
        }

        if ($application->user_id != auth()->user()->id) {
            return response(['error' => 'You are not the application owner, can\'t perform that action.'], 401);
        }

        $user = \App\Models\User::where('uuid', $subscriber_uuid)->first();

        if (!$user) {
            return response(['error' => 'Invalid user UUID or user not subscribed to this application'], 404);
        }

        // Get SubscribedApplication model where uuid matches user_uuid and application_id matches application_id
        $subscriber = SubscribedApplication::where('user_id', $user->id)
            ->with('user')
            ->where('application_uuid', $request->get('application_uuid'))
            ->first();

        return response()->json($subscriber->user->only('uuid', 'name', 'wifiDeviceUuids'), 200);
    }
}
