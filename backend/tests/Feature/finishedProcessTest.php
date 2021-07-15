<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class finishedProcessTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_FinishedProcessOk()
    {
        $postData = [
            "status" => "OK",
            "output" => "5",
            "finished_at" => "2021-07-05 11:56"

        ];
        $response = $this->postJson('api/process/2282866f-32b5-44d1-828d-d400cd1f088f/finished', $postData);
        
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_FinishedProcessNotFound()
    {
        $postData = [
            "status" => "OK",
            "output" => "5",
            "finished_at" => "2021-07-05T11:56:59.745013Z"

        ];
        $response = $this->postJson('api/process/2282866f-32b5-44d1-828d-d1f088f/finished', $postData);
        
        $response->assertStatus(404);
    }
}
