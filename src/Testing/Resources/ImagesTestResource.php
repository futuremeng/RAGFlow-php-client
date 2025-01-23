<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\ImagesContract;
use RAGFlow\Resources\Images;
use RAGFlow\Responses\Images\CreateResponse;
use RAGFlow\Responses\Images\EditResponse;
use RAGFlow\Responses\Images\VariationResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class ImagesTestResource implements ImagesContract
{
    use Testable;

    protected function resource(): string
    {
        return Images::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function edit(array $parameters): EditResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function variation(array $parameters): VariationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
