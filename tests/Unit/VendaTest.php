<?php

namespace Tests\Unit;

use App\Http\Resources\VendaResource;
use App\Models\Venda;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class VendaTest extends TestCase
{

    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateVenda()
    {
        $valor      = rand (1*10, 99*10) / 10;
        $response   = $this->json('POST', '/api/vendas', ['vendedor_id' => 1, 'valor' => $valor]);

        $response->assertStatus(200);
    }

    public function testListVenda()
    {
        $response = $this->json('GET', '/api/vendas', [
            'doAssigned' => false,
            'doValidate' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => array(['id', 'nome', 'email', 'comissao', 'valor', 'data_venda'])
        ]);
    }

    public function testShowVenda()
    {
        $venda = new VendaResource(Venda::first());

        $response = $this->json('GET', '/api/vendas/'.$venda->id, [
            'doAssigned' => false,
            'doValidate' => false,
        ]);

        $response->assertStatus(200)
            ->assertExactJson(['data' => $venda->toArray($venda)]);
    }
}
