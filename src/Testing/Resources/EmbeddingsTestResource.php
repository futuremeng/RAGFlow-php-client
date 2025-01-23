<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\EmbeddingsContract;
use RAGFlow\Resources\Embeddings;
use RAGFlow\Responses\Embeddings\CreateResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class EmbeddingsTestResource implements EmbeddingsContract
{
    use Testable;

    protected function resource(): string
    {
        return Embeddings::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
