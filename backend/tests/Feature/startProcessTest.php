<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class startProcessTest extends TestCase
{
    /**
     * start process test OK
     *
     * @return void
     */
    public function test_startProcessTestOk()
    {
       
        $response = $this->post('api/process/2282866f-32b5-44d1-828d-d400cd1f088f/start');
        
        $response->assertStatus(200);
       
    }

    /**
     * start process test NOT FOUND
     *
     * @return void
     */
    public function test_startProcessTestNotFound()
    {
       
        $response = $this->post('api/process/2282866f-32b5-44d1-828d-d4d1f0f/start');
        
        $response->assertStatus(404);
       
    }
}
