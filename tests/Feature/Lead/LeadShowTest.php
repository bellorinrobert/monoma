<?php

namespace Tests\Feature\Lead;

use App\Models\Lead;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadShowTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * A basic feature test example.
     */
    /**
     * Summary of test_get_success_true
     * @return void
     */
    public function test_get_success_true(): void
    {
        
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
