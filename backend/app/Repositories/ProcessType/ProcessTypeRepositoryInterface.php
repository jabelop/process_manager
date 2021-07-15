<?php

namespace App\Repositories\ProcessType;

use App\Repositories\RepositoryInterface;

interface ProcessTypeRepositoryInterface extends RepositoryInterface
{
    public function findWithProcessTypeField(string $processType);
}