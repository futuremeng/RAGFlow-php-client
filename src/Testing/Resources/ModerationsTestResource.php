<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\ModerationsContract;
use RAGFlow\Resources\Moderations;
use RAGFlow\Responses\Moderations\CreateResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class ModerationsTestResource implements ModerationsContract
{
    use Testable;

    protected function resource(): string
    {
        return Moderations::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
