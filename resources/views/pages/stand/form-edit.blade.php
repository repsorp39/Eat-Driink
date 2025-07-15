@extends("layout.base")

@section("title","Eat&Drink - Produits")

@section("header")
    @include("components.header")
@endsection


@section('content')
 <div class="w-[500px] mx-auto p-4 shadow-sm rounded-md bg-gray-800">
    <form method="POST" action="{{ route("product-update") }}" enctype="multipart/form-data">
        @csrf
        <fieldset class="fieldset rounded-box border p-4 [&_div]:mb-3">
            <legend class="fieldset-legend text-gray-400 text-lg ">Éditer un produit</legend>
            <div class="avatar">
                <div class="mask mask-hexagon-2 w-16 mx-auto -mt-6 -mb-16">
                    <img src="{{ $product["image_url"] }}" />
                </div>
            </div>             
            <x-input-row
                name="name"
                type="text"
                label="Nom du produit"
                :value="$product['name']"
                />
            <x-input-row
                name="price"
                type="number"
                label="Prix unitaire (FCFA)"
                :value="$product['price']"
                />
            <x-input-row
                name="description"
                type="text"
                label="Description"
                :value="$product['description']"
            />
            <div class="flex">            
                <x-input-row
                    name="image_url"
                    type="file"
                    label="Image illustrative (obligatoire)"
                />                                
            </div>
               <input type="hidden" name="product_id" value="{{ request()->route('id') }}">
        </fieldset>
        
        <span onclick="my_modal_3.close()" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</span>
        <button class="w-full btn btn-success mt-3">Ajouter</button>
    </form>
</div>
@endsection