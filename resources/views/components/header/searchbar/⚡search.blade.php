<?php

use Livewire\Component;

new class extends Component
{
    public $search = '';
};
?>

<div class="w-full px-2 md:px-0 flex gap-1">
    <div class="flex-1">
        <x-input wire:model="search" icon-right="o-magnifying-glass" class="w-full outline-0 border-0 rounded-full px-3 text-lg flex-1" />
    </div>

    <x-header.searchbar.user-panel />
</div>
