<div class="flex flex-col items-center relative pb-2"
x-data="{open: false}"
x-on:close-all-maquininhas.window="open = false">
    <div class="items-end h-60 flex justify-center mb-4">
        <img loading="lazy" class="w-40" src="{{ $image }}" alt="Maquininha {{ $image }}">
    </div>

    <div class="p-4">
        <h4 class="font-segoe-ui text-center mb-3 font-bold">
            <span class="text-passou-magenta text-3xl">{{ $name }}</span>
        </h4>
    </div>
    <x-btn-default href="#" x-on:click.prevent="asdf" :bg="true" class="px-8 font-segoe-ui font-bold">
        Saiba mais
        <x-slot name="icon">
            <x-icon name="chevron-right" class="fill-white group-hover:fill-white transition-all duration-200" />
        </x-slot>
    </x-btn-default>

    <div
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="absolute left-16 top-full bg-passou-magenta px-8 py-5 rounded-xl shadow-lg">
        {{ $list }}
    </div>

    <script>
        function asdf() {
            if(this.open) {
                this.open = false;
                return;
            }
            this.$dispatch('close-all-maquininhas');
            this.open = true;
        }

    </script>
</div>
