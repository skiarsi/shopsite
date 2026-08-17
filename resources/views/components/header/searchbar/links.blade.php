<div class="w-full flex gap-1 items-center align-middle pt-2 ps-2 md:ps-0 md:pt-0">
    <a class="lg:block text-white text-sm" href="{{ route('home') }}" wire:navigate >{{ __("links_home") }}</a>
    <a class="text-white text-sm rounded-full py-2 px-5 hover:bg-red-800" href="#" wire:navigate >{{ __("links_5star") }}</a>
    <a class="hidden lg:block text-white text-sm rounded-full py-2 px-5 hover:bg-red-800" href="#" wire:navigate >{{ __("links_best_selling") }}</a>
    {{-- <x-header.searchbar.category /> --}}
    <livewire:header.searchbar.category />
</div>
