<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\EditsContract;
use RAGFlow\Resources\Edits;
use RAGFlow\Responses\Edits\CreateResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class EditsTestResource implements EditsContract
{
    use Testable;

    protected function resource(): string
    {
        return Edits::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
