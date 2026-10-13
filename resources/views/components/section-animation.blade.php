@props(['show' => true])

<div
    x-show="{{ $show }}"
    x-cloak
    x-transition:enter="transition-all ease-in-out duration-700"
    x-transition:enter-start="opacity-0 scale-y-0"
    x-transition:enter-end="opacity-100 scale-y-100"
    x-transition:leave="transition-all ease-in-out duration-300"
    x-transition:leave-start="opacity-100 scale-y-100"
    x-transition:leave-end="opacity-0 scale-y-0"
    style="transform-origin: top;"
>
    {{ $slot }}
</div>