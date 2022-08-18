<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class OnlineWifiDevices extends Widget
{
    protected static string $view = 'filament.widgets.online-wifi-devices';

    protected int | string | array $columnSpan = 'full';

    public function mount(): void
    {
        $this->devices = auth()->user()->wifiDevices()->get();
    }
}
