<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Sessions\SessionDeleteResponse;
use RAGFlow\Responses\Sessions\SessionListResponse;
use RAGFlow\Responses\Sessions\SessionResponse;

interface SessionsContract
{
    /**
     * Create an assistant with a model and instructions.
     *
     * @see https://ragflow.server/docs/api-reference/assistants/createSession
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): SessionResponse;

    /**
     * Retrieves an assistant.
     *
     * @see https://ragflow.server/docs/api-reference/assistants/getSession
     */
    public function retrieve(string $id): SessionResponse;

    /**
     * Modifies an assistant.
     *
     * @see https://ragflow.server/docs/api-reference/assistants/modifySession
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): SessionResponse;

    /**
     * Delete an assistant.
     *
     * @see https://ragflow.server/docs/api-reference/assistants/deleteSession
     */
    public function delete(string $id): SessionDeleteResponse;

    /**
     * Returns a list of assistants.
     *
     * @see https://ragflow.server/docs/api-reference/assistants/listSessions
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): SessionListResponse;
}
