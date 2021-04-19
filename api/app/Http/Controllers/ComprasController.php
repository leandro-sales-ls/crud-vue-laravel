<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compras;
use App\Repositories\ComprasRepository;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = new ComprasRepository;
        $compras = $repository->findAll();
        return $compras;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dt_compra' => 'required|date',
            'cod_produto' => 'required|max:255',
            'qtd_prod_compra' => 'required|max:11',
        ]);
        try {
            $error = "";
            $compras = "";
            $data = $request->all();   
            $compras = new Compras;
            $compras->fill($data);
            $compras->save();
        } catch(\Exception $e) {
            $error='Erro ao salvar Filme' . $e;
        }
        return response()->json([
            'error' => $error,
            'data'  => $compras
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = new ComprasRepository;
        $compras = $repository->find($id);
        return $compras;
    }
    

}
