<?php

namespace App\Repositories\ProcessType;

use App\Models\ProcessType;
use App\Repositories\ProcessType\ProcessTypeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcessTypeRepository implements ProcessTypeRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(ProcessType $processType)
    {
        $this->model = $processType;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $processType = $this->model->find($id)) {
            throw new ModelNotFoundException("Process not found");
        }

        return $processType;
    }

    public function findWithProcessTypeField(string $processType) {
        
        if (null == $processType = $this->model->where('type',$processType)->first()) {
            throw new ModelNotFoundException("Process not found");
        }

        return $processType;   
    }

}