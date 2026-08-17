<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

@placeholder
    <div class="skeleton btn btn-sm min-w-30 italic bg-white rounded-sm text-white bg-white/30 border-0 outline-0 shadow-none">
        loading...
    </div>
@endplaceholder

<div class="flex">

    @auth
        <div class="flex gap-2 btn btn-sm rounded-sm btn-ghost hover:bg-white/20 border-0 outline-0 shadow-none">
            <span class=" text-white">
                {{ mb_strtoupper(Str::limit(auth()->user()->name,8)) }}
            </span>
            <div class="w-8 h-8 rounded-full overflow-hidden">
                <img class="w-full" src="{{ auth()->user()->profile?->avatar }}" />
            </div>
        </div>
    @endauth
    

    @guest
        <a wire:navigate href="/login" class="btn btn-sm min-w-30 rounded-sm btn-ghost text-white hover:bg-white/20 border-0 outline-0 shadow-none">
            {{ __('login') }}    
        </a>
    @endguest
</div>
