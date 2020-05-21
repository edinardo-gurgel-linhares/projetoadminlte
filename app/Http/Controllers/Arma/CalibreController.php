<?php

namespace App\Http\Controllers\Arma;

use App\Http\Controllers\Controller;
use App\Models\Arma\Calibre;
use Illuminate\Http\Request;

class CalibreController extends Controller

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
    public function calibre_lista()
    {
        $lista = Calibre::all();
        $user = Auth()->User();
        $calibre = 'calibre';
        $uri = $this->request->route()->uri();
        $exploder = explode( '/', $uri);
        $uriAtual = $exploder[1];

        
        //O compact envia os dados do calibre para a View 
        return view('arma.calibre.lista', compact('user','calibre', 'uriAtual', 'lista'));
    }

}
