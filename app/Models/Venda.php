<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendedor;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vendedor_id',
        'valor',
        'comissao',
        'created_at'
    ];

    public function vendedor()
    {
        return $this->hasOne(Vendedor::class, 'id', 'vendedor_id');
    }
}
