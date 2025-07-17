@extends("layout.base")

@section("header")
    @include("components.header")
@endsection


@section("content")
    <section class="min-h-screen">
        <x-list-product-component >
            <h1 class="text-4xl text-white text-NunitoBold">Tous les stands disponibles</h1>
            <p class="text-sm text-gray-400">Ayez l'embarras du choix dans cette multitude d'incroyables stands</p>
            <section class="grid grid-cols-3 gap-5 mt-7">
                @foreach ($stands as $stand)
                    <div class="card bg-gray-800 w-72  h-100 shadow-sm">
                        <figure class="px-10 pt-10">
                            <img
                            src="{{ $stand["business_img"] }}"
                            alt=""
                                class="rounded-xl" />
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title"> {{ $stand["stands"]["stand_name"] }} </h2>
                            <p> {{ Str::limit($stand["stands"]["description"],100) }} </p>
                            <div class="card-actions">
                                <a href="{{ route("stand-info",["id" => $stand["id"]]) }}" class="btn btn-soft btn-neutral">Visiter</a>
                            </div>
                        </div>
                    </div>                
                @endforeach                
            </section>
        </x-list-product-component>
    </section>
@endsection

@section("footer")
    @include("components.footer")
@endsection