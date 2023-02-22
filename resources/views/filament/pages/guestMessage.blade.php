<div wire:poll.1s="checkAckReceivedGuest">
    @if(Cache::has($guest_ack_id) && Cache::get($guest_ack_id) == true)
        <div class="text-center p-5">
            <span class="text-lg text-green-400">{{$successMessageAccept}}</span>
        </div>
    @endif
</div>
