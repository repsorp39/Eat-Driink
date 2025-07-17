@extends("layout.base")

@section("header")
    @include("components.header")
@endsection

@section("content")
    <section class="min-h-screen">
        <a href="{{ route("stand") }}" class="btn btn-outline btn-circle btn-accent">
            <i class="bi bi-arrow-left"></i>
        </a>
        <article class="bg-gradient-to-br from-gray-900 to-gray-800 p-4 g flex justify-start gap-5 items-center place-content-center">
            <div>
                <div class="avatar">
                    <div class="mask mask-squircle w-24">
                        <img src="{{ $user["business_img"] }}" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 place-items-center">
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Entreprise détentrice</h4>
                    <p> {{ $user["business_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Nom du stand</h4>
                    <p> {{ $user["stands"]["stand_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Description</h4>
                    <p title="{{ $user["stands"]["description"] }}" class="text-sm"> {{ Str::limit($user["stands"]["description"],70) }} </p>
                </div>
                <div class="w-[250px] h-[100px] relative shadow-md border-white border-2 rounded-lg p-3">
                    <span class="text-4xl text-emerald-700 font-bold"> {{ count($user["stands"]["products"]) }} </span>
                    <span class="absolute right-0 bottom-0 m-2 text-gray-400 ms-4 text-NunitoBold text-lg uppercase">Produits disponibles</span>
                </div>
            </div>
        </article>
        <ul class="grid grid-cols-3 mt-8">
            @foreach ($user["stands"]["products"] as $product)
                <li class="card bg-base-100 w-72 shadow-sm">
                    <figure>
                        <img
                        src="{{ $product["image_url"] }}"
                        alt="{{  $product["name"] }}" />
                    </figure>
                    <div class="card-body bg-gray-800">
                        <h2 class="card-title">{{ $product["name"]}}</h2>
                        <p> {{ $product["description"] }} </p>
                        <div class="card-actions justify-end">
                        <button class="btn btn-outline btn-accent"><i class="bi bi-cart"></i> Ajouter au panier</button>
                        </div>
                    </div>
                    </li>
            @endforeach
        </ul>
    </section>
@endsection

@section("footer")
    @include("components.footer")
@endsection

