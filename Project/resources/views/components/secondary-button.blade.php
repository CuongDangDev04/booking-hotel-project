<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-light text-xs font-semibold text-gray-700 rounded-md shadow-sm hover:bg-light focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
