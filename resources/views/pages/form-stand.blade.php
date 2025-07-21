@extends("layout.base")
@section("content")
    <section class="py-8">
     <div>
        <a href="/" class="btn btn-outline btn-circle btn-accent">
            <i class="bi bi-arrow-left"></i>
        </a>   
     </div>
     <div class="mt-2">
        <div class="py-5">
            <div class="w-[50%] mx-auto bg-gray-800">
            <div class=" mb-3 flex items-center justify-between">
                <div class="w-24 h-16 p-3">
                    <img src="/images/eat-drink-logo.png"  alt="">
                </div>
                <h1 class="text-gray-400 p-3 text-xl font-extrabold">Demande de stands</h1>
            </div>
            <form action="{{ route("stand-request") }}" method="POST" class="p-3 [&_input]:text-black" enctype="multipart/form-data">
                @csrf
                <fieldset class="fieldset rounded-box border p-4 [&_div]:mb-3">
                    <legend class="fieldset-legend text-gray-400 text-lg ">Informations personnelles</legend>

                    <div>
                        <label class="label" for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            class="input w-full" 
                            name="email" 
                            placeholder="monemail@machin.com" 
                            value="{{ old("email") }}"
                        />
                        @error("email")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="fullname">Nom complet</label>
                        <input 
                            type="text" 
                            id="fullname" 
                            class="input w-full" 
                            name="owner_fullname" 
                            placeholder="John Doe" 
                            value="{{ old("owner_fullname") }}"
                        />
                        @error("owner_fullname")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                    

                    <div>
                        <label class="label" for="password">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            class="input w-full" 
                            name="password" 
                            placeholder="MonSuperMotDePasse134!" 
                            value="{{ old("password") }}"
                        />
                        @error("password")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="fieldset rounded-box border p-4 mt-4">
                    <legend class="fieldset-legend text-lg text-gray-400">Votre entreprise</legend>

                    <div>
                        <label class="label" for="entreprise">Nom de l'entreprise</label>
                        <input 
                            type="text" 
                            id="entreprise" 
                            class="input w-full" 
                            name="business_name" 
                            placeholder="PopperParty" 
                            value="{{ old("business_name") }}"
                        />
                        @error("business_name")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div>
                        <fieldset class="fieldset">
                        <legend class="text-gray-400">Choisissez une image (facultatif)</legend>
                        <input 
                            type="file" 
                            class="file-input w-full" 
                            name="business_img"
                        />
                        <label class="label">Taille maximale 2MB</label>
                        </fieldset>
                        @error("business_img")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="fieldset rounded-box border p-4 mt-4">
                    <legend class="fieldset-legend text-lg text-gray-400">Détails sur le stand</legend>
                    <div>
                        <label class="label" for="stand_name">Nom du stand</label>
                        <input 
                            type="text" 
                            id="stand_name" 
                            class="input w-full" 
                            name="stand_name" 
                            placeholder="Vive les pommes!" 
                            value="{{ old("stand_name") }}"
                        />
                        @error("stand_name")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div>
                        <label class="label" for="description">Que dire de votre stand ?</label>
                        <textarea
                            type="text" 
                            id="description" 
                            class="input w-full text-black h-[50px] resize-none" 
                            name="description" 
                            placeholder="Les pommes c'est la vie!" 
                            value="{{ old("description") }}"
                        ></textarea>
                        @error("description")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                    
                </fieldset>
                <button type="submit" class="btn btn-success mt-3 w-full">Soumettre</button>
                <div class="mt-3">
                    <p class="text-center text-sm"> Déjà de compte ? <a  href="/login" class="underline decoration-1 text-gray-300">Se connecter</a> </p>
                </div>                
            </form>
        </div>
        </div>
    </div>
    </section>
 @endsection

 @section("footer")
    @include("components.footer")
 @endsection