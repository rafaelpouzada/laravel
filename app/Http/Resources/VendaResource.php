<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendaResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->vendedor->nome,
            'email' => $this->vendedor->email,
            'comissao' => $this->comissao,
            'valor' => $this->valor,
            'data_venda' => $this->created_at
        ];
    }
}
