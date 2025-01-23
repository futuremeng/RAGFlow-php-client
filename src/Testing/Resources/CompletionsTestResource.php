<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\CompletionsContract;
use RAGFlow\Resources\Completions;
use RAGFlow\Responses\Completions\CreateResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class CompletionsTestResource implements CompletionsContract
{
    use Testable;

    protected function resource(): string
    {
        return Completions::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
