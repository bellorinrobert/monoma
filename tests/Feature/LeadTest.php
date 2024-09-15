<?php
/**
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-13
 * 
 */
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Summary of test_create_success
     * @return void
     */
    public function test_create_success_true(): void
    {
        $response = $this->postJson('/lead', [
            'name' => "Mi candidato"
            , 'source' => "Fotocasa"
            , 'owner' => 2
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'meta' => [
                        'success' => true
                        , "errors" => []
                    ], 'data' => [
                        'id' => 1
                        , "name" => "Mi candidato"
                        , 'source' => "Fotocasa"
                        , "owner" => 2
                        , "created_at" => "2020-09-01 16:16:16"
                        , "created_by" => 1
                    ]
                ]);
    }
    /**
     * Summary of test_create_success_false
     * @return void
     */
    public function test_create_success_false(): void
    {
        $response = $this->postJson('/lead', [
            'name' => "Mi candidato"
            , 'source' => "Fotocasa"
            , 'owner' => 2
        ]);

        $response->assertStatus(401)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Token expired"
                        ]
                    ]
                ]);
    }
    /**
     * Summary of test_get_success_true
     * @return void
     */
    public function test_get_success_true(): void
    {
        $response = $this->getJson('/lead/1');

        $response->assertStatus(200)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Token expired"
                        ]
                    ], 'data' => [
                        "id" => 1
                        , "name" => "Mi candidato"
                        , "source" => "Fotocasa"
                        , "owner" => 2
                        , "created_at" => "2020-09-01 16:16:16"
                        , "created_by" => 1
                    ]
                ]);
    }
    /**
     * Summary of test_get_success_false_401
     * @return void
     */
    public function test_get_success_false_401(): void
    {
        $response = $this->getJson('/lead/1');

        $response->assertStatus(401)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Token expired"
                        ]
                    ]
                ]);
    }
    /**
     * Summary of test_get_success_false_404
     * @return void
     */
    public function test_get_success_false_404(): void
    {
        $response = $this->getJson('/lead/1');

        $response->assertStatus(404)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Token expired"
                        ]
                    ]
                ]);
    }
    /**
     * Summary of test_get_index_success_true
     * @return void
     */
    public function test_get_index_success_true(): void
    {
        $response = $this->getJson('/leads');

        $response->assertStatus(200)
                ->assertJson([
                    'meta' => [
                        'success' => true
                        , "errors" => []
                    ], "data" => [
                        [
                            'id' => 1
                            , 'name' => "Mi candidato"
                            , 'source' => "Fotocasa"
                            , 'owner' => 2
                            , 'created_at' => "2020-09-01 16:16:16"
                            , 'created_by' => 1
                        ],
                        [
                            'id' => 2
                            , 'name' => "Mi candidato 2"
                            , 'source' => "Habitaclia"
                            , 'owner' => 2
                            , 'created_at' => "2020-09-01 16:16:16"
                            , 'created_by' => 1
                        ],
                    ]
                ]);
    }
    public function test_get_index_success_false(): void
    {
        $response = $this->getJson('/leads');

        $response->assertStatus(200)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Token expired"
                        ]
                    ]
                ]);
    }
}
