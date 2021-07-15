<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostProcessTest extends TestCase
{
    /**
     * successful post process request
     *
     * @return void
     */
    public function test_succesfulPostProcessRquest()
    {
        $postData = [
            'id' => "2282866f-32b5-44d1-828d-d400cd1f088f",
            'type' => 'VOWELS_COUNT',
            'input' => 'test input'
        ];
        $response = $this->postJson('api/process', $postData);
        
        $response->assertStatus(201);
        $response->assertExactJson(['error' => false, 'code' => 'OK', 'msg' => "Process created successfully"], true);
    }
    /**
     * less id value length post process request
     *
     * @return void
     */
    public function test_lessIdLengthPostProcessRquestTest()
    {
        $postData = [
            'id' => "2286f-32b5-44d1-828d-d400cd1f088f",
            'type' => 'VOWELS_COUNT',
            'input' => 'test input'
        ];
        $response = $this->postJson('api/process', $postData);
        
        $response->assertStatus(500);
        $response->assertExactJson(['error' => true, 'code' => '500', 'msg' => "wrong value: 2286f-32b5-44d1-828d-d400cd1f088f"], true);
    }
    /**
     * bad char in id value post process request
     *
     * @return void
     */
    public function test_badCharIdPostProcessRquestTest()
    {
        $postData = [
            'id' => "2286f-32b5-44d1-82#d-d400cd1f088f",
            'type' => 'VOWELS_COUNT',
            'input' => 'test input'
        ];
        $response = $this->postJson('api/process', $postData);
        
        $response->assertStatus(500);
        $response->assertExactJson(['error' => true, 'code' => '500', 'msg' => "wrong value: 2286f-32b5-44d1-82#d-d400cd1f088f"], true);
    }
    /**
     * more id value length post process request
     *
     * @return void
     */
    public function test_moreIdLengthPostProcessRquestTest()
    {
        $postData = [
            'id' => "2286f-32b5-445d1-82d55d-d400cd1f088f",
            'type' => 'VOWELS_COUNT',
            'input' => 'test input'
        ];
        $response = $this->postJson('api/process', $postData);
        
        $response->assertStatus(500);
        $response->assertExactJson(['error' => true, 'code' => '500', 'msg' => "wrong value: 2286f-32b5-445d1-82d55d-d400cd1f088f"], true);
    }

    /**
     * bad char in type value post process request
     *
     * @return void
     */
    public function test_badCharTypePostProcessRquestTest()
    {
        
        $postData = [
            'id' => "2282866f-32b5-44d1-828d-d400cd1f088f",
            'type' => 'VOWELS5COUNT',
            'input' => 'test input'
        ];
        $response = $this->postJson('api/process', $postData);
        
        $response->assertStatus(500);
        $response->assertExactJson(['error' => true, 'code' => '500', 'msg' => "wrong value: VOWELS5COUNT"], true);
    }
}
