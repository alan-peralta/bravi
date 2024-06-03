<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class Test1ControllerTest extends TestCase
{
    public function testValidBrackets()
    {
        $response = $this->json('GET', route('test-1'), ['query' => '(){}[]']);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['valid' => true]);

        $response = $this->json('GET', route('test-1'), ['query' => '[{()}](){}']);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['valid' => true]);
    }

    /**
     * Test invalid brackets.
     *
     * @return void
     */
    public function testInvalidBrackets()
    {
        $response = $this->json('GET', route('test-1'), ['query' => '[]{()']);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['valid' => false]);

        $response = $this->json('GET', route('test-1'), ['query' => '[{)]']);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['valid' => false]);
    }
}
