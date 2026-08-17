<x-layouts::app>
    <div class="w-full lg:w-11/12 xl:w-9/12 mx-auto flex justify-between flex">
        <div class="flex-1 px-2 bg-gray-100">
            <x-recommended-products :limit="4" />
        </div>

        <div class="hidden lg:block w-[180px] bg-yellow-400">&nbsp;</div>
    </div>
</x-layouts::app>
