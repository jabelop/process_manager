<?php

namespace App\Repositories\Process;

use App\Models\Process;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcessRepository implements ProcessRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Process $process)
    {
        $this->model = $process;
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
        if (null == $process = $this->model->find($id)) {
            throw new ModelNotFoundException("Process not found");
        }

        return $process;
    }

    public function findWithProcessIdField(string $processId) {
        
        if (null == $processType = $this->model->where('process_id',$processId)->first()) {
            throw new ModelNotFoundException("Process not found");
        }

        return $processType;   
    }
}