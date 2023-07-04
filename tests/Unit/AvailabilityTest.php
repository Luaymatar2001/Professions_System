<?php

namespace Tests\Unit;

use Tests\TestCase;

class AvailabilityTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRouteAvailability()
    {
        $response = $this->get('/admin/login'); // Replace 'your-route' with the actual route you want to test

        $response->assertStatus(200);
    }
}