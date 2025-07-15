@extends("layout.base")

@section("title","Eat&Drink - Produits")

@section("header")
    @include("components.header")
@endsection


@section("content")
    <x-list-product-component 
        title="Produits"
        description="Ajouter,modifier et supprimer les produits de votre stand"
    >
    <a href="/products/new" class="absolute flex btn btn-light bg-emerald-200 font-bold right-0 top-0 m-2 shadow-lg" >
        <span class="w-8 h-8 grid place-content-center bg-emerald-500/20 rounded-full ">
            <i class="bi bi-plus-lg text-md" ></i>
        </span>Ajouter
    </a>
{{-- 
    <form action="" class="absolute left-0 mt-3 mx-4">
        <label class="input text-gray-800">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g
                stroke-linejoin="round"
                stroke-linecap="round"
                stroke-width="2.5"
                fill="none"
                stroke="currentColor"
                >
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" class="grow" placeholder="Search" />
        </label>
    </form> --}}

    @if(count($products) === 0)
        <section class="mt-20">
            <div class="flex flex-col items-center justify-center mt-5 font-Montsera text-lg text-center shadow-ghost-content shadow-2xl rounded-2xl w-32 h-32 ">
                <i class="bi bi-ban text-[120px] text-gray-500"></i>
            </div>
        </section>
    @endif

    </x-list-product-component>
@endsection