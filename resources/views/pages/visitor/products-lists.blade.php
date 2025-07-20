@extends("layout.base")

@section("header")
    @include("components.header")
@endsection


@php
    $isSearching = isset($query) && !empty($query)
@endphp

@section("content")
    <section class="min-h-screen">
        <section class="flex justify-between">
            <div>
                <a href="{{ route("stand") }}" class="btn btn-outline btn-circle btn-light">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <section>
                <form class="flex" action="" method="GET">
                    <input minlength="3" value="{{ request()->query("query") }}"  name="query" class="input text-gray-600" placeholder="Rechercher un stand ou un produit..." type="search" name="" id="">
                    <button class="btn btn-outline btn-square  btn-light"> <i class="bi bi-search"></i> </button>
                </form>
            </section>  
        </section>
        @if($isSearching)
            @php
                $message = "Résultats de le recherche pour ".  $query ."- ".  count($products) . " résultat(s) trouvé(s)"
            @endphp
           
            @if (count($products) > 0)
                    <x-success-message :message="$message" />
            @else
                    <x-error-message :message="$message" />
            @endif
        @endif
        
        @if (session("success"))
            <x-success-message :message="session('success')" />
        @endif
        <article class="bg-gradient-to-br my-10 from-gray-900 to-gray-800 p-4 g flex justify-start gap-5 items-center place-content-center">
            <div>
                <div class="avatar">
                    <div class="mask mask-squircle w-24">
                        <img src="{{ $stand["user"]["business_img"] }}" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 place-items-center">
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Entreprise détentrice</h4>
                    <p> {{ $stand["user"]["business_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Nom du stand</h4>
                    <p> {{ $stand["stand_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Description</h4>
                    <p title="{{ $stand["description"] }}" class="text-sm"> {{ Str::limit($stand["user"]["stands"]["description"],70) }} </p>
                </div>
                <div class="w-[250px] h-[100px] relative shadow-md border-white border-2 rounded-lg p-3">
                    <span class="text-4xl text-emerald-700 font-bold"> {{ count($stand["user"]["stands"]["products"]) }} </span>
                    <span class="absolute right-0 bottom-0 m-2 text-gray-400 ms-4 text-NunitoBold text-lg uppercase">Produits disponibles</span>
                </div>
            </div>
        </article>
        <ul class="grid grid-cols-3 mt-20">
            @foreach ($products as $product)
                <li class="card bg-base-100 w-72 shadow-sm mt-5">
                    <figure>
                        <img
                        src="{{ $product["image_url"] }}"
                        alt="{{  $product["name"] }}" />
                    </figure>
                    <div class="card-body bg-gray-800">
                        <h2 class="card-title">{{ $product["name"]}}</h2>
                        <p> {{ Str::limit($product["description"], 100) }} </p>
                        <div class="card-actions justify-end">
                        <button class="open-modal-btn btn btn-light" data-id="{{ $product["id"] }}" onclick="my_modal_3.showModal()" class="btn btn-outline btn-light"><i class="bi bi-cart"></i> Ajouter au panier</button>
                        </div>
                    </div>
                    </li>
            @endforeach
        </ul>

        <label  
            id="user-cart" 
            for="my_modal_7"
            class="h-10 w-16 flex flex-col justify-center rounded-s-3xl cursor-pointer fixed text-black right-0 top-[calc(100vh/2-40px/2)] p-4 bg-white">
            <i class="bi bi-cart3 text-2xl"></i>
            <span  id="card-element" class="absolute -top-2 left-0 px-1 text-sm bg-red-500 rounded-lg">0</span>
        </label>
    </section>

    {{-- Modal to see products in our card --}}
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="text-lg text-black font-bold">Liste des produits</h3>
            <form action="/order" method="POST" id="order-form">
                @csrf
                <ul id="product-list" class="list text-black rounded-box shadow-md">
                  <p class="text-center m-2 text-sm text-gray-500">Votre panier est vide</p>
                </ul>
                <input class="stand-id" type="hidden" name="stand_id">
                <input class="order-details" type="hidden" name="order_details">
                <button class="btn btn-outline btn-success mt-5">Commander</button>
            </form>
        </div>
        <label class="modal-backdrop" for="my_modal_7">Close</label>
    </div>

    {{-- Modal to set a quantity for a product --}}
    <dialog id="my_modal_3" class="modal bg-gray-600 text-black">
        <div class="modal-box">
            <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Définir la quantité:</h3>
            <input 
                min="1" 
                value="1"
                max="20" 
                type="number" 
                class="input product-quantity w-full"
            >
            <button 
                id="card-submit" 
                type="submit" 
                class="btn btn-outline btn-success mt-4">
            Ajouter au panier</button>
        </div>
    </dialog>
@endsection

@section("footer")
    @include("components.footer")
@endsection

@vite(["resources/js/user-cart.js"])



