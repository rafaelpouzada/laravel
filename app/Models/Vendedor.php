<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venda;

class Vendedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'email'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function vendas()
    {
        return $this->belongsTo(Venda::class, 'id', 'vendedor_id');
    }
}
