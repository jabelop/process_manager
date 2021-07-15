<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Request\RequestHelper;
use App\Http\Helpers\Response\ApiResponse;
use App\Http\Helpers\Response\ResponseInterface;
use App\Http\Helpers\Utilities\Utilities;
use App\Repositories\Process\ProcessRepositoryInterface;
use App\Repositories\ProcessType\ProcessTypeRepository;
use Exception;
use Hamcrest\Util;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    /** @var ProcessRepositoryInterface */
    private $repository;


   /** @var ResponseInterface */
    private $apiResponse;

    const POST_PROCESS_VALIDATION_DATA_RULES = [
        'id' => '/([a-f]|[0-9]){8}\-([a-f]|[0-9]){4}\-([a-f]|[0-9]){4}\-([a-f]|[0-9]){4}\-([a-f]|[0-9]){12}/',
        'type' =>  '/([a-zA-Z])+\_([a-zA-Z])+/',
        'input' => '/.+/'
    ];

    // process status codes
    const NOT_STARTED = 'NOT_STARTED';
    const STARTED = 'STARTED';
    const FINISHED = 'FINISHED';
    const ERROR = 'ERROR';
    

    public function __construct(ProcessRepositoryInterface $repository, ResponseInterface $apiResponse)
    {
        $this->repository = $repository;
        $this->apiResoponse = $apiResponse;
    }

    /**
     * Store a new process.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON response with the result
     */
    public function postProcess(Request $request)
    {
        
        try {
            $id = RequestHelper::validateDataFromRequest($request->input('id',''), self::POST_PROCESS_VALIDATION_DATA_RULES['id']);
            $type = RequestHelper::validateDataFromRequest($request->input('type',''), self::POST_PROCESS_VALIDATION_DATA_RULES['type']);
            $input = RequestHelper::validateDataFromRequest($request->input('input',''), self::POST_PROCESS_VALIDATION_DATA_RULES['input']);

            $this->repository->create([
                'process_id' => $id, 
                'type' => $type,
                'input' => $input,
                'status' => self::NOT_STARTED,
                'started_at' => null,
                'finished_at' => null
            ]);
            
            $processCreatedMsg = "Process created successfully";
            
            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=>false, 
                'code' => "OK", 
                'msg' =>$processCreatedMsg
            ])
            ->sendApiResponse(response(), 201);
            
        
        } catch (\Throwable $e) {

            // when testing the value is not injected 
            $this->apiResponse = $this->apiResponse ? $this->apiResponse : new ApiResponse();
            http_response_code(500);
            
            return $this->apiResponse
            ->setArrayValues([
                'error'=> true, 
                'code' => "500", 
                'msg' => $e->getMessage()
            ])
            ->sendApiResponse(response(), 500);
            
        }
    }
    
    /**
     * get a new process.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getProcessList(Request $request) {
        return $this->repository->all();
    }
}