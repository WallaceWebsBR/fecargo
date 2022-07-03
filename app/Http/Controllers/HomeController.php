<?php

namespace App\Http\Controllers;

use App\Models\Cotacoes;
use Illuminate\Http\Request;
use App\Models\TabelaFretes;
use App\Models\User;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function frete(){
        return view('frete');
    }

    public function volumes(){
        return view('volumes');
    }

    public function financeiro(){
        return view('financeiro');
    }

    public function calculo_frete(Request $request){

        try {
            $uf = $request->input('uf');
            $cidade = $request->input('cidade');
    
            $nf = $request->input('nf') ?? 0;
            $seguro = $request->input('seguro') ? $request->input('seguro') / 100 : 0.8/100;
    
            $frete = TabelaFretes::where('uf', $uf)
                ->where('cidade', $cidade)
                ->first();
            foreach ($request->cargas as $carga) {
                $peso = $carga['peso'];
                $cubado = $carga['qtd'] * $carga['altura'] * $carga['largura'] * $carga['comprimento'] / 6000;
                if($cubado < $peso) {
                    $pesofinal[] = $cubado;
                } else {
                    $pesofinal[] = $peso;
                }
            }
            $pesototal = array_sum($pesofinal);
            $valorfrete = ($frete->taxa_minima + ($pesototal * $frete->por_kg)) + ($request->input('nf') * $request->input('seguro'));
    
            Cotacoes::create([
                'uf' => $uf,
                'cidade' => $cidade,
                'cep' => $request->input('cep'),
                'peso' => $pesototal,
                'valor' => $valorfrete,
            ]);
            
            return redirect()->route('home.index');

        } catch (Exception $e ) {

            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }

    }
}
