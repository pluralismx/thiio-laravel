<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->post('/api/register');
        $response->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $response = $this->post('/api/login');
        $response->assertStatus(200);
    }

    // Create users route tests

    public function test_user_can_create_records()
    {
        $response = $this->post('/api/customers/save');
        $response->assertStatus(200);
    }

    public function test_user_can_update_records()
    {
        $response = $this->put('/api/customers/update/{id}');
        $response->assertStatus(200);
    }

    public function test_user_can_read_records()
    {
        $response = $this->get('/api/customers/records');
        $response->assertStatus(200);
    }

    public function test_user_can_delete_records()
    {
        $response = $this->delete('/api/customers/delete/{id}');
        $response->assertStatus(200);
    }


}
