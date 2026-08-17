<div class="min-w-[190px] flex gap-2 items-center ps-1 align-middle">
    
    <a href="/ai-search" wire:navigate class="text-white text-sm bg-red-800 rounded-full py-2 px-4 flex align-middle gap-2" >
        <x-icon name="tabler.ai-agents" /> {{ __("ai-search") }}
    </a>


    <div class="flex gap-1 align-middle select-none cursor-pointer hover:bg-white/10 rounded-full py-2 px-4">
        <x-icon name="tabler.message-language" class="text-white" />
        <span class="text-white font-bold text-sm ">{{ __("language") }}</span>
    </div>


    @auth
        <x-icon name="o-shopping-cart" class="text-white w-6 cursor-pointer hover:text-gray-200" />
    @endauth
</div>
