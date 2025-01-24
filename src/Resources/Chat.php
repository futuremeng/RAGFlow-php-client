<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 13:04:37
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 20:34:25
 * @FilePath: /RAGFlow-php-client/src/Resources/Chat.php
 * @Description:
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare (strict_types = 1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\ChatContract;
use RAGFlow\Responses\Chat\CreateResponse;
use RAGFlow\Responses\Chat\CreateStreamedResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Chat implements ChatContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * Creates a completion for the chat message
     *
     * @see https://ragflow.server/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $chat_id = $parameters['chat_id'];

        unset($parameters['chat_id']);

        $payload = Payload::create('chats/' . $chat_id . 'completions', $parameters);

        /** @var Response<array{id: string, object: string, created: int, model: string, system_fingerprint?: string, choices: array<int, array{index: int, message: array{role: string, content: ?string, function_call: ?array{name: string, arguments: string}, tool_calls: ?array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }

    /**
     * Creates a streamed completion for the chat message
     *
     * @see https://ragflow.server/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $chat_id = $parameters['chat_id'];

        unset($parameters['chat_id']);

        $payload = Payload::create('chats/' . $chat_id . '/completions', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }
}
