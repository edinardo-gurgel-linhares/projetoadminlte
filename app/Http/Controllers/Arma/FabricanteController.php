<?php

namespace App\Http\Controllers\Arma;

use App\Http\Controllers\Controller;
use App\Models\Arma\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller

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
    public function fabricante_lista()
    {
        $lista = Fabricante::all();
        $user = Auth()->User();
        $fabricante = 'fabricante';
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados do fabricante para a View 
        return view('arma.fabricante.lista', compact('user','fabricante', 'uriAtual', 'lista'));
    }

}
