@props([
    "title" => "",
    "description" => "",
])

<div class="min-h-[70vh] bg-gradient-to-br from-gray-900 to-gray-800 p-4 relative">
    <section>
    {{-- <div> --}}
        <h1 class="font-bold text-white text-3xl">{{ $title }}</h1>
        <p class="mt-2 text-sm text-gray-500"> {{ $description }} </p>
    {{-- </div> --}}
    {{-- <div>
        <a href=""></a>
    </div> --}}
    </section>
    <div class="grid place-content-center">
        {{ $slot }}
    </div>
</div>