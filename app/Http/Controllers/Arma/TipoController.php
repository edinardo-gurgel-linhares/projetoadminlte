<?php

namespace App\Http\Controllers\Arma;

use App\Http\Controllers\Controller;
use App\Models\Arma\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller

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
    public function tipo_lista()
    {
        $lista = Tipo::all();
        $user = Auth()->User();
        $tipo = 'tipo';
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados do Tipo para a View 
        return view('arma.tipo.lista', compact('user','tipo', 'uriAtual', 'lista'));
    }

}
