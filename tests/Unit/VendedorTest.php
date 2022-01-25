<?php

namespace Tests\Unit;

use App\Http\Resources\VendedorResource;
use App\Models\Vendedor;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class VendedorTest extends TestCase
{

    use WithFaker;
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateVendedor()
    {
        $email      = explode('@', $this->faker->unique()->safeEmail)[0] . '@gmail.com';
        $response   = $this->json('POST', '/api/vendedores', ['nome' => $this->faker->name, 'email' => $email]);
        $response->assertStatus(200);
    }

    public function testListVendedor()
    {
        $response = $this->json('GET', '/api/vendedores', [
            'doAssigned' => false,
            'doValidate' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => array(['id', 'nome', 'email', 'comissao'])
        ]);
    }

    public function testShowVendedor()
    {
        $vendedor = Vendedor::first();

        $response = $this->json('GET', '/api/vendedores/'.$vendedor->id, [
            'doAssigned' => false,
            'doValidate' => false,
        ]);

        $response->assertStatus(200)
            ->assertExactJson($vendedor->toArray($vendedor));
    }
}
