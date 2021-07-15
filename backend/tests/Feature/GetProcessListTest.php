<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetProcessListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET','api/process');
         
        $response->assertStatus(200);
        
        // be sure this data is inserted into the database before you run this test
        $response->assertJson(fn (AssertableJson $json) => 
            $json->first(fn ($firstProcess) =>
                $firstProcess->where('process_id', "2282866f-32b5-44d1-828d-d400cd1f098f")
                             ->where('type', 'VOWELS_COUNT')
                             ->where('input', 'another test')
                             ->etc()
            )
            
            
            
        );
    }
}
