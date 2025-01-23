<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\ChatContract;
use RAGFlow\Resources\Chat;
use RAGFlow\Responses\Chat\CreateResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class ChatTestResource implements ChatContract
{
    use Testable;

    protected function resource(): string
    {
        return Chat::class;
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
