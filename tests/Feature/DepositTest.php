<?php

namespace Tests\Feature;

use App\Http\Controllers\Purchase;
use App\Http\Requests\PurchaseRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepositTest extends TestCase
{
    use RefreshDatabase; // Reset database after each test

    public function testCreatePurchase()
    {
        $data = [
            'amount' => 10,
            'description' => 'test',
            'user_id' => 1,
            'date' => '2024-03-31'
        ];

        $this->createUserAndLogin();

        //$response = $this->post('/purchases', $data);
        //dd($response);
        //$response->assertStatus(201);
        //$this->assertDatabaseHas('purchases', $data);
    }

    protected function createUserAndLogin()
    {
        $data = [
            'usename' => 'user',
            'email' => 'email@bnb.com',
            'password' => '123456',
        ];

        $response = $this->post('login/store', $data);
        $response->assertStatus(201);
    }
}
