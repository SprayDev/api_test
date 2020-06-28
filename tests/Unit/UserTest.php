<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    //use RefreshDatabase;

    public function test_user_test()
    {
        $token = 'NGiF0GgD7qtAslluFTTAWaf0JNAMc8dZ1GyvqNW60Gd6QfwcTXaLrmJCfSQm2TTK12G0F7VGwoiK8gjY';
        $response = $this->get('/api/member/get/4?api_token='.$token);

        $response->assertStatus(200);
    }
}
