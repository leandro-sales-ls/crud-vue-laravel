<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Repositories\UsuarioRepository;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = new UsuarioRepository; 
        return $repository->findAll();
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
            
            'nome' => 'required|max:255',
            'status' => 'required',
           
        ]);
        
        try{
            $error = "";
            $usuario = "";
            $data = $request->all();
            $usuario = new Usuario;
            $usuario->fill($data);
            $usuario->save();
        } catch(\Exception $e) {
            $error='Erro ao salvar o Usuario' . $e;
        }
        return response()->json([
            'error' => $error,
            'data'  => $usuario
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
        $repository = new UsuarioRepository;
        $usuario = $repository->find($id);
        return $usuario;
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
        $request->validate([
            
            'nome' => 'required|max:255',
            'status' => 'required',
           
        ]);
        
        $error = "";
        $data = $request->all();
        $produto = "";
        $produto = Usuario::find($id);
        try {
            $produto->update($data);
        }catch(\Exception $e){
            $error='Erro ao atualizar o produto ' . $e;
        }
        return response()->json([
            'error' => $error,
            'data'  => $produto
        ]);
    }

    public function produtosEstoque()
    {
        $dados=[];
        $repository = new UsuarioRepository;
        $usuario = $repository->produtosEstoque();

        foreach ($usuario as $produto) {
            $dados[] = [
                'nome_produto' => $produto->nome,
                'descricao' => $produto->descricao,
                'qtd_disponivel' => $produto->qtd_compras - $produto->qtd_vendas,
            ];
        }
        return $dados;
    }

    /**
     *
     * @param  \App\Time
     * @return \Illuminate\Http\Response
     */
    public function delete($codigo)
    {
        $error = "";
        $data = "";

        $repository = new UsuarioRepository;
        $usuario = $repository->find($codigo);
        
        if ($usuario)
        {
            try {
                $delete = $repository->delete($codigo);
            }catch(\Exception $e){
                $error='Erro ao excluir Usuario' . $e;
            }
            
        } else {
            $error = "Usuario não encontrado";
        }

        return response()->json([
            'error' => $error,
            'data'  => $usuario
        ]);

    }

}
