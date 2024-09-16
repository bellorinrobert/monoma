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

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Summary of setUp
     * @return void
     */
    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Summary of test_login_success_true
     * @return void
     */
    public function test_login_success_true(): void
    {
        
        $response = $this->postJson('/auth', [
            'username' => "tester",
            'password' => "PASSWORD"

        ]);

        

        $response->assertStatus(200)
                ->assertJson([
                    'meta' => [
                        'success' => true
                        , "errors" => []
                    ], 'data' => [
                        // 'token' => $token
                        // ,
                         "minutes_to_expire" => 1440
                    ]
                ]);

        
    }
    /**
     * Summary of test_login_success_false
     * @return void
     */
    public function test_login_success_false(): void
    {

        $response = $this->postJson('/auth', [
            'username' => "tester",
            'password' => "PASSWORL"

        ]);
        

        $response->assertStatus(401)
                ->assertJson([
                    'meta' => [
                        'success' => false
                        , "errors" => [
                            "Password incorrect for: tester"
                        ]
                    ]
                ]);

        
    }
}
