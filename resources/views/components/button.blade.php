<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#2E4EAD] dark:bg-[#2E4EAD] border border-transparent rounded-md font-semibold text-xs text-white hover:bg-[#1E3A8A]']) }}>
    {{ $slot }}
</button>
