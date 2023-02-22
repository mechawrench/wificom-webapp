@if($user_selected_com_host != 'none' && $battle_type != 'none')
    <div wire:poll.1s="checkAckReceivedHost">
        @if(Cache::has($host_ack_id) && Cache::get($host_ack_id) == true)
            <div class="text-center p-5">
                <span class="text-lg text-green-400">{{$successMessageInitiate}}</span>
            </div>
        @endif
    </div>
@endif
