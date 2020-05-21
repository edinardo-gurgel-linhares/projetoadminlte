<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PainelController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $request;

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
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[0];
        
        //O compact envia os dados de usuario para a View 
        return view('painel.index', compact('user', 'uriAtual'));

        }

}
