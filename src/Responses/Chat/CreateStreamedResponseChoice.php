<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 13:04:37
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-24 10:20:28
 * @FilePath: /one-api-plus/Users/mengfanyong/github/RAGFlow-php-client/src/Responses/Chat/CreateStreamedResponseChoice.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Chat;

final class CreateStreamedResponseChoice
{
    private function __construct(
        public readonly string $answer,
        public readonly CreateStreamedResponseReference $reference,
        public readonly ?bindec $audio_binary,
        public readonly string $id,
        public readonly string $session_id,
    ) {}

    /**
     * @param  array{answer: string, reference: array, audio_binary: bindec|null, id: string, session_id: string} $attributes
     * 
     * {
     *   "answer": "I am an intelligent assistant designed to help answer questions by summarizing content from a",
     *   "reference": {"total": 0, "chunks": [], "doc_aggs": []},
     *   "audio_binary": null,
     *   "id": "a84c5dd4-97b4-4624-8c3b-974012c8000d",
     *   "session_id": "82b0ab2a9c1911ef9d870242ac120006"
     * }
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['answer'],
            CreateStreamedResponseReference::from($attributes['reference'] ?? []),
            $attributes['audio_binary'] ?? null,
            $attributes['id'],
            $attributes['session_id'],
        );
    }

    /**
     * @return array{answer: string, reference: array, audio_binary: bindec|null, id: string, session_id: string}
     */
    public function toArray(): array
    {
        return [
            'answer' => $this->answer,
            'reference' => $this->reference->toArray(),
            'audio_binary' => $this->audio_binary,
            'id' => $this->id,
            'session_id' => $this->sessionId,
        ];
    }
}
