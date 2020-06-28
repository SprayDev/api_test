<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $token = 'NGiF0GgD7qtAslluFTTAWaf0JNAMc8dZ1GyvqNW60Gd6QfwcTXaLrmJCfSQm2TTK12G0F7VGwoiK8gjY';
        $baseUrl = Config::get('app.url') . '/api/member/get/party/1?api_token=NGiF0GgD7qtAslluFTTAWaf0JNAMc8dZ1GyvqNW60Gd6QfwcTXaLrmJCfSQm2TTK12G0F7VGwoiK8gjY';
        $this->withExceptionHandling();
        $response = $this->get('/api/member/get/4');

        $response->assertStatus(500);
    }
}
