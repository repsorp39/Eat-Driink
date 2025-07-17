@extends("layout.base")



@section("content")
<section class="p-5">
    <div>
        <a href="/" class="btn btn-outline btn-circle btn-accent">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>
    <section class="w-[400px] mx-auto">
        <form action="{{ route("login-post") }}" class="bg-gray-800 shadow-lg p-4 rounded-md" method="POST" class="p-3 [&_input]:text-black" enctype="multipart/form-data">
                @csrf
                @if (session("success"))
                    <p class="p-3 rounded-xl text-light  text-emerald-400 text-sm text-center my-2">{{ session("success")}}</p>
                @endif
                @if (session("error"))
                    <p class="p-3  text-red-500 text-sm text-center my-2">{{ session("error")}}</p>
                @endif
                <fieldset class="fieldset rounded-box border p-4 [&_div]:mb-3">
                    <legend class="fieldset-legend text-gray-400 text-lg ">Se connecter</legend>

                    <div>
                        <label class="label" for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            class="input w-full text-black" 
                            name="email" 
                            placeholder="monemail@machin.com" 
                            value="{{ old("email") }}"
                        />
                        @error("email")
                            <p class="label text-red-700 max-w-[300px] break-words break-all"> {{ $message }} </p>
                        @enderror
                    </div>

                
                    <div>
                        <label class="label" for="password">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            class="input w-full text-black" 
                            name="password" 
                            placeholder="MonSuperMotDePasse134!" 
                            value="{{ old("password") }}"
                        />
                        @error("password")
                            <p class="label text-red-700"> {{ $message }} </p>
                        @enderror
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success mt-3 w-full">Soumettre</button>
                <div class="mt-3">
                    <p class="text-center text-sm"> Pas encore de compte ? <a  href="/stand-request" class="underline decoration-1 text-gray-300">S'inscrire</a> </p>
                </div>
            </form>
    </section>    
</section>
@endsection