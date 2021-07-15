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

    /**
     * start a process
     * 
     * @param string $id, the process id to start
     */
    public function startProcess($id) {
        
        $responseCode = 200;
        try {

            $process = $this->repository->findWithProcessIdField($id);

            $processType = $this->processTypeRepository->findWithProcessTypeField($process->type);
            
            $this->repository->update(['status' => self::STARTED], $process->id);
            
            $processCommand = escapeshellcmd('node '.Utilities::getProcessesPath().$processType['command'].' "'.$process->input.'"');
            
            $output = str_replace("\n",'', shell_exec($processCommand));
    
            if (is_numeric($output)) {

                $this->repository->update([
                    'output' => $output, 
                    'status' => self::FINISHED, 
                    'finished_at' => date('Y-m-d H:i:s')
                ], $process->id);

            }
            else {
                $this->repository->update([
                    'output' => $output, 
                    'status' => self::ERROR,
                    'finished_at' => date('Y-m-d H:i:s')
                ], $process->id);
            }

        } catch (ModelNotFoundException $e) {
            $responseCode = 404;
        }
       
        return response()->noContent($responseCode);
        
    }

    /**
     * update finished process with its output and result status
     * 
     * @param string $id, the process id to start
     */
    public function finishedProcess($id, Request $request) {

        $status = $request->input('status');
        $output = $request->input('output');
        $finishedAt = $request->input('finished_at');

        $responseCode = 200;

        try {
            $process = $this->repository->findWithProcessIdField($id);
            
            $this->repository->update([
                'status' => $status, 
                'output' => $output, 
                'finished_at' => $finishedAt
            ], $process->id);

        } catch (ModelNotFoundException $e) {
            $responseCode = 404;
        }

        return response()->noContent($responseCode);

    }
}