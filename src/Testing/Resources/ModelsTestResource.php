<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\ModelsContract;
use RAGFlow\Resources\Models;
use RAGFlow\Responses\Models\DeleteResponse;
use RAGFlow\Responses\Models\ListResponse;
use RAGFlow\Responses\Models\RetrieveResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class ModelsTestResource implements ModelsContract
{
    use Testable;

    protected function resource(): string
    {
        return Models::class;
    }

    public function list(): ListResponse
    {
        return $this->record(__FUNCTION__);
    }

    public function retrieve(string $model): RetrieveResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $model): DeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
