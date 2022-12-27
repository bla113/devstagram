<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
  public function __construct(){

    $this->middleware('auth')->except(['show','index']);//AUTENTICACION
  }
    public function index(User $user){

      $posts= Post::where('user_id',$user->id)->latest()->paginate(5);

      

        return view('dashboard',[
          'user'=>$user,
          'posts'=>$posts
        ]);

    }


    public function create()
    {//nos prmite tener el formulario tipo GET para mostrarlo

      
      return view('posts.create'); 
    }


    public function store(Request $request)
    {// nos permite guardar la inforamcion POST

      
     //dd('Creando la Publicacion'); 

      $this->validate($request,[

        'titulo' => 'required|max:255',
        'description'=>'required',
        'imagen'=>'required'

      ]);


      /* Post::create([
        'titulo'=>$request->titulo,
        'descripcion'=> $request->description,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id
        ]); */



        /*$post = new Post;
        $post->titulo=$request->titulo;
        $post->descripcion= $request->description;
        $post->imagen=$request->imagen;
        $post->user_id=auth()->user()->id;
        $post->save();*/

        $request->user()->posts()->create([
          'titulo'=>$request->titulo,
          'descripcion'=> $request->description, 
          'imagen'=>$request->imagen,
          'user_id'=>auth()->user()->id
        ]);





        return redirect()->route('posts.index', auth()->user()->username);
      

      





    }

    public function Show(User $user, Post $post)//estas variables se pasan por que en la ruta las esta pidiendo
    {
      return view('posts.show',[
        'post'=>$post,
        'user'=>$user
      ]);
    }



    public function destroy(Post $post){

   
      $this->authorize('delete',$post);

      $post->delete();

      $imagen_path= public_path('uploads/'.$post->imagen);

      if(File::exists($imagen_path)){
        unlink($imagen_path);
      
      }

      return redirect()->route('posts.index',auth()->user()->username);


    }



}
