<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this -> request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_lista()
    {
        $lista = User::all();
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados de usuario para a View 
        return view('user.lista', compact('user', 'uriAtual', 'lista'));
    }

}
