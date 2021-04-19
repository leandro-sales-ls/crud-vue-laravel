<?php

namespace App\Repositories;

use App\Usuario;
use Illuminate\Support\Facades\DB;

class UsuarioRepository
{

	public function findAll()
	{
        return  Usuario::all();
	}

    public function find($codigo)
	{
		return Usuario::where('codigo', $codigo)->get();
	}

	public function delete($codigo)
	{
		return DB::table('usuarios')->where('codigo', $codigo)->delete();
	}



}
