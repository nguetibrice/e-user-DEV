<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Traits\ApiClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $url = env('APP_URL');
        $openPack = Http::get($url . '/api/v1/subscription/packages');

        $response = new ApiClient();

        $element = $response->handleResponse($openPack);

        $this->assertNotEmpty($element);
    }
}
