<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ProcessType\ProcessTypeRepositoryInterface;

use Illuminate\Http\Request;

class ProcessTypeController extends Controller
{

    /** @var ProcessTypeRepositoryInterface */
    private $repository;
    public function __construct(ProcessTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;

    }

    /**
     * get a new process.
     *
     * @param  Request  $request
     * 
     * @return string, the JSON request with the result
     */
    public function getProcessTypeList(Request $request) {
        return $this->repository->all();
    }
    
}