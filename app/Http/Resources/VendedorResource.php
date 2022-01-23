<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendedorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'comissao' => (double) number_format($this->vendas()->sum('comissao'), 2, '.', '')
        ];
    }
}
