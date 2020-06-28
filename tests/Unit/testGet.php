<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class testGet extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function getExample()
    {
        $response = $this->get('/member/get/4');
        $response->assertStatus(200);
    }
}
