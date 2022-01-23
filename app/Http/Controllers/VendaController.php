<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendaResource;
use App\Models\Venda;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::all()->toArray();
        return array_reverse($vendas);
    }

    public function store(Request $request)
    {

        \DB::beginTransaction();

        try {

            $rules = array(
                'vendedor_id'  => 'required|numeric',
                'valor' => 'required|numeric|min:0|not_in:0',
            );
            $messages = array(
                'vendedor_id.required' => 'Por favor informe um vendedor',
                'vendedor_id.numeric' => 'Por favor informe um vendedor',
                'valor.required' => 'Por favor informe um valor para a venda!',
                'valor.numeric' => 'Por favor informe um valor válido para a venda!',
                'valor.not_in' => 'Por favor informe um valor válido para a venda!',
                'valor.min' => 'Por favor informe um valor válido para a venda!'
            );
            $validator = \Validator::make( $request->all(), $rules, $messages );

            if ($validator->fails())
            {
                return response()->json(['error' => $validator->errors()->toArray()], 422);
            }

            $vendedor = Vendedor::find($request->input('vendedor_id'));

            if(!$vendedor)
            {
                return response()->json(['error' => "Vendedor não encontrado"], 422);
            }

            $venda = new Venda([
                'vendedor_id' => $request->input('vendedor_id'),
                'valor' => $request->input('valor'),
                'comissao' => number_format((($request->input('valor') * $vendedor->comissao) / 100), 2, '.', '')
            ]);

            $venda->save();

            \DB::commit();

            return response()->json([
                'id' => $venda->id,
                'nome' => $venda->vendedor->nome,
                'email' => $venda->vendedor->email,
                'comissao' => (double) $venda->comissao,
                'valor' => $venda->valor,
                'data_venda' =>$venda->created_at
            ]);

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }

    public function getVendasVendedor($id)
    {

        try {

            $vendedor = Vendedor::find($id);

            if(!$vendedor)
            {
                return response()->json(['error' => "Vendedor não encontrado"], 422);
            }

            $vendas = Venda::where('vendedor_id', $id)->get();

            return VendaResource::collection($vendas);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
