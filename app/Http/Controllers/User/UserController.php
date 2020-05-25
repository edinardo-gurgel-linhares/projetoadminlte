<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Roles\Roles;
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
    public function index()
    {
        $lista = User::all();
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados de usuario para a View 
        return view('user.lista', compact('user', 'uriAtual', 'lista'));
    }

    public function store(Request $request)
    {
        $store = User::create($request->all());
        if($store)
            return redirect()->route("user.lista")->with('success', 'Usuário Cadastrado com Sucesso');
        return redirect()->back()->with('error', 'Houve um erro ao cadastrar o usuário');
    
    }

    public function create()
    {
        $title = 'Cadastro de Usuários';
        $roles = Roles::all();
        $user = Auth()->User();
        $classe = new User();
        
        //O compact envia os dados de usuario para a View 
        return view('user.create', compact('title', 'user', 'classe', 'roles'));
    }

}
