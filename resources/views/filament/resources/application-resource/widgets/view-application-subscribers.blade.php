<x-filament::widget>
    <x-filament::card>
        <h2 class="text-2xl">App Subscribers</h2>
        @if($subscribersCount > 0)
        <ul>
            @foreach($subscribers as $subscriber)
                {{ $subscriber }}
            @endforeach
        </ul>
        @else
            No subscribers on this application yet.
        @endif
    </x-filament::card>
</x-filament::widget>
