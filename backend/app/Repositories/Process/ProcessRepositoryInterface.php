<?php

namespace App\Repositories\Process;

use App\Repositories\RepositoryInterface;

interface ProcessRepositoryInterface extends RepositoryInterface
{
    public function findWithProcessIdField(string $processId);
}