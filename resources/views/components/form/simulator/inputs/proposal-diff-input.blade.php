@props([
    'label' => false,
    'id' => false,
    'min' => 0,
    'useDiff' => false,
    'step' => '0.01'
])

<div class="relative mb-4 flex flex-wrap items-stretch">
    @if($label)
        <span
            class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-sm font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
        >{{$label}}</span
        >
    @endif

    <input
        type="number"
        class="relative m-0 block w-[1px] min-w-0 flex-auto border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
        aria-label="Quantidade"
        name="{{$id}}"
        id="{{$id}}"
        step="{{$step}}"
        min="{{$min}}"
    />

        @if($useDiff)
            <span
                class="flex text-green-500 items-center whitespace-nowrap rounded-r border border-l-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
                id="{{$id}}_diff"
            >
                0,40%</span
            >
        @endif
</div>
