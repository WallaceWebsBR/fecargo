<?php

namespace App\Http\Controllers;

use App\Exports\ExportTabelaFretes;
use App\Imports\ImportTabelaFretes;
use App\Models\TabelaFretes;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BancoDeDadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = TabelaFretes::all();
        $tabelas = TabelaFretes::select('nome_tabela')->distinct()->get();

        $dados = [
            // 'data' => $data,
            'tabelas' => $tabelas,
        ];

        return view('admin/banco_de_dados', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()) {
            return TabelaFretes::all();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(Request $request)
    {
        Excel::import(new ImportTabelaFretes, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportTable(Request $request)
    {
        return Excel::download(new ExportTabelaFretes, 'tabela_fenix.xlsx');
    }
    
    public function removeTable(Request $request)
    {
        TabelaFretes::where('nome_tabela', $request->nome_tabela)->delete();
        return redirect()->back();
    }
}
