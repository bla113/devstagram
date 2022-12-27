<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){//user es el perfil que estamos visitando

        $user->followers()->attach(auth()->user()->id);// con parentesis permite ingresar al metodo


        return back();
    }

    public function destroy(User $user){//user es el perfil que estamos visitando

        $user->followers()->detach(auth()->user()->id);// con parentesis permite ingresar al metodo


        return back();
    }
}
