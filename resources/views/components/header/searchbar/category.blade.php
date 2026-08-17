<div
    class="flex relative"
    x-data="{ clicked : false }"
    @click.outside="clicked = false">
    
    <span
        @click="clicked = !clicked"
        class="min-w-[124px] text-white text-sm rounded-full py-2 px-5 cursor-pointer hover:bg-red-800"
        :class="{'bg-red-800' : clicked}">
        {{ __("category") }}

        <x-icon x-show="!clicked" name="o-chevron-down" class="w-5" />
        <x-icon x-show="clicked" name="o-chevron-up" class="w-5" />
    </span>

    <div
        x-show="clicked"
        class="absolute top-10 md:left-0 bg-stone-100 w-screen md:w-[610px] py-3 px-4 z-50 rounded-md shadow">
        &nbsp;
    </div>
</div>
