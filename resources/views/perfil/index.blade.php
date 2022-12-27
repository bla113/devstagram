@extends('layouts.app')
@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')

<div class="md:flex md:justify-center">
    <div class="mb:w-1/2 gb-white shadow p-6">
        <form class="mt-10 md:mt-0" method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data">
            
            @csrf
            <div class="mb-5">
                <label for="username"  class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario</label>
                <input type="text" value="{{auth()->user()->username}}" placeholder="Tu Nombre de usuario" name="username" id="username" class="boder p-3 w-full rounded-lg @error('username')
                @enderror" value="{{old('username')}}">
                
                @error('username') 
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen"  class="mb-2 block uppercase text-gray-500 font-bold">Imagen</label>
                <input type="file" accept=".jpg,.png,.jpeg" name="imagen" id="imagen" class="boder p-3 w-full rounded-lg">
              
            </div>


            <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

    </div>


</div>
    
@endsection