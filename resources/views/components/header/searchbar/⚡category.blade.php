<?php

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

new class extends Component
{
    public $categories = [];

    public function mount()
    {
        $this->categories = Cache::rememberForever('categories_tree', function () {
            return Category::whereNull('parent_id')
                ->with('children')
                ->get()
                ->toArray();
        });
    }
};
?>

<div
    class="flex relative"
    x-data="{ clicked: false, activeCategory: null }"
    x-init="activeCategory = {{ json_encode($categories[0] ?? null) }}"
    @click.outside="clicked = false">
    
    <span
        @click="clicked = !clicked"
        class="min-w-[124px] text-white text-sm rounded-full py-2 px-5 cursor-pointer hover:bg-red-800 flex items-center justify-between"
        :class="{'bg-red-800' : clicked}">
        {{ __("category") }}

        <x-icon x-show="!clicked" name="o-chevron-down" class="w-5" />
        <x-icon x-show="clicked" name="o-chevron-up" class="w-5" />
    </span>

    <div
        x-show="clicked"
        x-cloak
        class="absolute top-10 md:left-0 w-screen md:w-[710px] z-50 rounded-xl shadow-xl flex overflow-hidden border border-gray-900/10">
        
        <div class="w-[250px] bg-stone-300 py-3 px-4 h-[600px] overflow-y-auto">
            <ul class="flex flex-col gap-1 text-sm text-gray-800">
                @foreach($categories as $category)
                    <li 
                        @mouseenter="activeCategory = {{ json_encode($category) }}"
                        :class="{'bg-white rounded-md': activeCategory?.id === {{ $category['id'] }}}"
                        class="py-1.5 px-3 cursor-pointer transition-colors duration-150 flex items-center justify-between hover:bg-stone-200">
                        <span>{{ $category['name'] }}</span>
                        <x-icon name="o-chevron-right" class="w-3.5 h-3.5 text-gray-500" />
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex-1 bg-stone-100 py-3 px-4 h-[600px] overflow-y-auto">
            <template x-if="activeCategory && activeCategory.children && activeCategory.children.length">
                <div>
                    <h3 x-text="activeCategory.name" class="text-gray-900 border-b pb-2 mb-3"></h3>
                    <ul class="grid grid-cols-2 gap-2 text-sm text-gray-700">
                        <template x-for="child in activeCategory.children" :key="child.id">
                            <li class="py-0.5 px-2 hover:text-red-700 cursor-pointer">
                                <a :href="'/category/' + child.slug" x-text="child.name"></a>
                            </li>
                        </template>
                    </ul>
                </div>
            </template>

            <template x-if="!activeCategory || !activeCategory.children || !activeCategory.children.length">
                <div class="text-gray-400 text-sm py-4 text-center">
                    &nbsp;
                </div>
            </template>
        </div>
    </div>
</div>
