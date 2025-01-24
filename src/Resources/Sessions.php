<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:12:39
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:16:20
 * @FilePath: /RAGFlow-php-client/src/Resources/Sessions.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\SessionsContract;
use RAGFlow\Responses\Sessions\SessionDeleteResponse;
use RAGFlow\Responses\Sessions\SessionListResponse;
use RAGFlow\Responses\Sessions\SessionResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Sessions implements SessionsContract
{
    use Concerns\Transportable;

    /**
     * Create an Session with a model and instructions.
     *
     * @see http://ragflow.server:9280/user-setting/api#create-chat-Session
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): SessionResponse
    {
        $payload = Payload::create('Sessions', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves an Session.
     *
     * @see https://ragflow.server/docs/api-reference/Sessions/getSession
     */
    public function retrieve(string $id): SessionResponse
    {
        $payload = Payload::retrieve('Sessions', $id);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies an Session.
     *
     * @see https://ragflow.server/docs/api-reference/Sessions/modifySession
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): SessionResponse
    {
        $payload = Payload::modify('Sessions', $id, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an Session.
     *
     * @see https://ragflow.server/docs/api-reference/Sessions/deleteSession
     */
    public function delete(string $id): SessionDeleteResponse
    {
        $payload = Payload::delete('Sessions', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of Sessions.
     *
     * @see https://ragflow.server/docs/api-reference/Sessions/listSessions
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): SessionListResponse
    {
        $payload = Payload::list('Sessions', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionListResponse::from($response->data(), $response->meta());
    }
}
