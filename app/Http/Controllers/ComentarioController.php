<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function Store(Request $resquest, User $user, Post $post){

        //validar

        $this->validate($resquest,[
            'comentario'=>'required|max:255'
        ]);



        //Almacenar el resultado

        Comentario::create([

            'user_id'=>auth()->user()->id,
            'post_id'=>$post->id,
            'comentario'=>$resquest->comentario

        ]);



        //Imprimir  mensaje


        return back()->with('mensaje','Comentario Realizado Correctamente');

    }
}
