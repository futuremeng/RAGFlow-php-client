<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\AssistantsContract;
use RAGFlow\Resources\Assistants;
use RAGFlow\Responses\Assistants\AssistantDeleteResponse;
use RAGFlow\Responses\Assistants\AssistantListResponse;
use RAGFlow\Responses\Assistants\AssistantResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class AssistantsTestResource implements AssistantsContract
{
    use Testable;

    public function resource(): string
    {
        return Assistants::class;
    }

    public function create(array $parameters): AssistantResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): AssistantResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function modify(string $id, array $parameters): AssistantResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): AssistantDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): AssistantListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
