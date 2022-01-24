<?php

namespace App\Http\Controllers;

use App\Jobs\VendasEmailJob;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SendVendasMailController extends Controller
{
    public function __invoke()
    {
        $details['email'] = 'rafaelmpouzada@gmail.com';
        $date = Carbon::today();
        $date->setTimezone('America/Sao_Paulo');
        $vendas = Venda::whereDate('created_at', $date)->get();
        dispatch(new VendasEmailJob($vendas, $details));
        return response()->json(['message' => 'Email enviado com sucesso!']);
    }
}
