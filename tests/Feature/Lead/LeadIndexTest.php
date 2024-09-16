<?php

namespace Tests\Feature\Lead;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_success_true(): void
    {
        $this->seed();

        $token = auth()
                ->attempt([
                    'username' => 'tester'
                    , 'password' => 'PASSWORD'
        ]);

        $response = $this
        ->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->getJson('/lead/1');

        $response->assertStatus(200)
                ->assertJson([
                    'meta' => [
                        'success' => true
                        , "errors" => []
                    ], 'data' => [
                        "id" => 1
                        , "name" => "Mi candidato"
                        , "source" => "Fotocada"
                        , "owner" => 2
                        , "created_at" => "2020-09-01 16:16:16"
                        , "created_by" => 1
                    ]
                ]);
    }
}
