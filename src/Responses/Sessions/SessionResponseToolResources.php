<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:18:58
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:22:11
 * @FilePath: /RAGFlow-php-client/src/Responses/Sessions/SessionResponseToolResources.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}>
 */
final class SessionResponseToolResources implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public ?SessionResponseToolResourceCodeInterpreter $codeInterpreter,
        public ?SessionResponseToolResourceFileSearch $fileSearch,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            isset($attributes['code_interpreter']) ? SessionResponseToolResourceCodeInterpreter::from($attributes['code_interpreter']) : null,
            isset($attributes['file_search']) ? SessionResponseToolResourceFileSearch::from($attributes['file_search']) : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'code_interpreter' => $this->codeInterpreter?->toArray(),
            'file_search' => $this->fileSearch?->toArray(),
        ]);
    }
}
