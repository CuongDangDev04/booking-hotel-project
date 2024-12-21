@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white bg-light'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'start-0';
        break;
    case 'top':
        $alignmentClasses = 'top-0';
        break;
    case 'right':
    default:
        $alignmentClasses = 'end-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-100'; // Bootstrap has no direct equivalent for w-48, use w-100 (full width) for demonstration.
        break;
}
@endphp

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" @click="open = ! open">
        {{ $trigger }}
    </button>

    <ul class="dropdown-menu {{ $alignmentClasses }} {{ $width }}" aria-labelledby="dropdownMenuButton" x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        style="display: none;" @click="open = false">
        <li class="dropdown-item {{ $contentClasses }}">
            {{ $content }}
        </li>
    </ul>
</div>
