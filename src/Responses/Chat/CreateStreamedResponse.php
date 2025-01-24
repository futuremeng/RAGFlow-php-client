<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 13:04:37
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-24 16:09:59
 * @FilePath: /RAGFlow-php-client/src/Responses/Chat/CreateStreamedResponse.php
 * @Description:
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare (strict_types = 1);

namespace RAGFlow\Responses\Chat;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    /**
     * @param  array<int, CreateStreamedResponseChoice>  $choices
     */
    private function __construct(
        public readonly int $code,
        public readonly array $data,
        // public readonly ?CreateResponseUsage $usage,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     * $artibutes = {
     *  "code": 0,
     *  "data": {
     *      "answer": "I am an intelligent assistant designed to help answer questions by summarizing content from a",
     *      "reference": {},
     *      "audio_binary": null,
     *      "id": "a84c5dd4-97b4-4624-8c3b-974012c8000d",
     *     "session_id": "82b0ab2a9c1911ef9d870242ac120006"
     *   }
     * }
     * @param  array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {

        return new self(
            $attributes['code'],
            $attributes['data'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'code'      => $this->code,
            'data'  => $this->data,
        ];
        
        return $data;
    }
}
