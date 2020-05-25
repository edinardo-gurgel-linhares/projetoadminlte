<?php

namespace App\Http\Controllers\Arma;

use App\Http\Controllers\Controller;
use App\Models\Arma\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller

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
    public function marca_lista()
    {
        $lista = Marca::all();
        $user = Auth()->User();
        $marca = 'marca';
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados do Marca para a View 
        return view('arma.marca.lista', compact('user','marca', 'uriAtual', 'lista'));
    }

}
