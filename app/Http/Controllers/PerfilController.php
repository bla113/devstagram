<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller

{


    public function __construct(){//proteje las url
        $this->middleware('auth');
    }
    public function index(){

        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'=>Str::slug($request->username) ]);
        
        $this->validate($request,[

            'username'=>['required','unique:users','min:3','max:20','not_in:twiter,editar-perfil']
        ]);

        if($request->imagen){

            $imagen=$request->file('imagen'); 
            
            $nombreImagen = Str::uuid() .".". $imagen->extension();
            

            $imagenServidor= Image::make($imagen);

            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles'). '/'. $nombreImagen;

            $imagenServidor->save($imagenPath);

            //Guardar Cambios

            $usuario = User::find(auth()->user()->id);
            $usuario->username=$request->username;
            $usuario->imagen = $nombreImagen ?? '';
            $usuario->save();

        return redirect()->route('posts.index',$usuario->username);

           /* return response()->json(['imagen'=>$nombreImagen]);*/

        }else{
            dd('No hay imagen');
        }


        
    
    }
}
 