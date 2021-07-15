<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetProcessTypeListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET','api/process_type');
         
        $response->assertStatus(200);
        
        // be sure this data is inserted into the database before you run this test
        $response->assertJson(fn (AssertableJson $json) => 
            $json->first(fn ($firstProcess) =>
                $firstProcess->where('type', "VOWELS_COUNT")
                             ->where('command', 'vowels_count.js')
                             ->etc()
            )      
        );
    }
}
