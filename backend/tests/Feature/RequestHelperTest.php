<?php

namespace Tests\Feature;

use App\Http\Controllers\ProcessController;
use App\Http\Helpers\Request\RequestHelper;
use Tests\TestCase;

class RequestHelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validateId()
    {
        $postData = [
            'id' => "2282866f-32b5-44d1-828d-d400cd1f088f",
            'type' => 'VOWELS_COUNT',
            'input' => 'test input'
        ];
        $validatedInput = RequestHelper::validateDataFromRequest($postData['id'], ProcessController::POST_PROCESS_VALIDATION_DATA_RULES['id']);
        assert($validatedInput === $postData['id']);

        $validatedInput = RequestHelper::validateDataFromRequest($postData['type'], ProcessController::POST_PROCESS_VALIDATION_DATA_RULES['type']);
        assert($validatedInput === $postData['type']);

        $validatedInput = RequestHelper::validateDataFromRequest($postData['input'], ProcessController::POST_PROCESS_VALIDATION_DATA_RULES['input']);
        assert($validatedInput === $postData['input']);

    }
}
