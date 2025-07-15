@props([
    "title" => "",
    "description" => "",
])

<div class="min-h-[70vh] bg-gradient-to-br from-gray-900 to-gray-800 p-4 relative">
    <div>
        {{ $slot }}
    </div>
</div>