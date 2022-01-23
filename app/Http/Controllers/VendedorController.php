<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendedorResource;
use Illuminate\Http\Request;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();

        return VendedorResource::collection($vendedores);
    }

    public function store(Request $request)
    {

        \DB::beginTransaction();

        try {

            $rules = array(
                'nome'  => 'required|max:255',
                'email' => 'required|email:rfc,dns|unique:vendedors',
            );
            $messages = array(
                    'nome.required'     => 'Por favor informe um nome para o vendedor!',
                    'email.unique'      => 'Já existe um vendedor cadastrado com este email!',
                    'email.required'    => 'Por favor informe um e-mail para o vendedor!',
                    'email.email'       => 'Por favor informe um e-mail válido para o vendedor!'
            );
            $validator = \Validator::make( $request->all(), $rules, $messages );

            if ($validator->fails())
            {
                return response()->json(['error' =>$validator->errors()->toArray()], 422);
            }

            $vendedor = new Vendedor([
                'nome' => $request->input('nome'),
                'email' => $request->input('email')
            ]);
            $vendedor->save();

            \DB::commit();

            return response()->json(['id' => $vendedor->id, 'nome' => $vendedor->nome, 'email' => $vendedor->email]);

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function show($id)
    {
        $vendedor = Vendedor::find($id);
        return response()->json($vendedor);
    }

    public function update($id, Request $request)
    {

        \DB::beginTransaction();

        try {

            $rules = array(
                'nome'  => 'max:255',
                'email' => 'email:rfc,dns|unique:vendedors,email,' . $id,
            );
            $messages = array(
                    'email.unique'      => 'Já existe um vendedor cadastrado com este email!',
                    'email.email'       => 'Por favor informe um e-mail válido para o vendedor!'
            );
            $validator = \Validator::make( $request->all(), $rules, $messages );

            if ($validator->fails())
            {
                return response()->json(['error' =>$validator->errors()->toArray()], 422);
            }

            $vendedor = Vendedor::find($id);

            if(!$vendedor)
            {
                return response()->json(['error' => "Vendedor não encontrado"], 422);
            }

            $vendedor->update($request->all());

            \DB::commit();

            return response()->json('Vendedor atualizado!');

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {

        \DB::beginTransaction();

        try {

            $vendedor = Vendedor::find($id);
            $vendedor->delete();

            \DB::commit();

            return response()->json('Vendedor removido!');

        } catch (\Exception $e) {
            \DB::rollBack();
        }
    }
}
