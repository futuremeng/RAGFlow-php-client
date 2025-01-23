<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\EditsContract;
use RAGFlow\Responses\Edits\CreateResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Edits implements EditsContract
{
    use Concerns\Transportable;

    /**
     * Creates a new edit for the provided input, instruction, and parameters.
     *
     * @see https://ragflow.server/docs/api-reference/edits/create
     *
     * @param  array<string, mixed>  $parameters
     *
     * @deprecated RAGFlow has deprecated this endpoint and will stop working by January 4, 2024.
     * https://ragflow.com/blog/gpt-4-api-general-availability#deprecation-of-the-edits-api
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('edits', $parameters);

        /** @var Response<array{object: string, created: int, choices: array<int, array{text: string, index: int}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }
}
